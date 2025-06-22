<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TotalPenghasilan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class StatistikPendapatanController extends Controller
{
    public function index(Request $request)
{
    // Get current date
    $currentDate = Carbon::now();
    $currentYear = $currentDate->year;
    $currentMonth = $currentDate->month;

    // Get filter values from request (ensure they're integers)
    $selectedYear = (int)$request->input('tahun', $currentYear);
    $selectedMonth = (int)$request->input('bulan', $currentMonth);
    
    // Generate list of years for dropdown (last 5 years)
    $years = range($currentYear, $currentYear - 4);

    // Create months array with numeric keys and month names
    $months = [];
    for ($i = 1; $i <= 12; $i++) {
        $months[$i] = Carbon::create()->month($i)->translatedFormat('F');
    }

    // Base query with filters
    $baseQuery = TotalPenghasilan::query()
        ->whereYear('created_at', $selectedYear)
        ->whereMonth('created_at', $selectedMonth);

    // Main statistics
    $totalPendapatan = $baseQuery->sum('total_harga');
    $jumlahTransaksi = $baseQuery->count();
    $rataTransaksi = $jumlahTransaksi > 0 ? $totalPendapatan / $jumlahTransaksi : 0;

    // Get monthly trend data for the selected year
    $monthlyData = TotalPenghasilan::whereYear('created_at', $selectedYear)
        ->selectRaw('MONTH(created_at) as bulan_num, SUM(total_harga) as total')
        ->groupByRaw('MONTH(created_at)')
        ->orderByRaw('MONTH(created_at) ASC')
        ->get()
        ->keyBy('bulan_num');

    // Prepare trend data for all months (fill with 0 if no data)
    $trenBulanan = collect();
    for ($month = 1; $month <= 12; $month++) {
        $monthData = $monthlyData->get($month, (object)['bulan_num' => $month, 'total' => 0]);
        $trenBulanan->push([
            'bulan' => Carbon::create()->month($month)->translatedFormat('M'),
            'total' => $monthData->total,
            'bulan_num' => $month
        ]);
    }

    // Studio income distribution
    $pendapatanPerStudio = TotalPenghasilan::whereYear('created_at', $selectedYear)
        ->whereMonth('created_at', $selectedMonth)
        ->selectRaw('id_studio, COUNT(*) as jumlah, SUM(total_harga) as total')
        ->groupBy('id_studio')
        ->get();

    return view('admin.statistikpendapatan', [
        'totalPendapatan' => $totalPendapatan,
        'jumlahTransaksi' => $jumlahTransaksi,
        'rataTransaksi' => $rataTransaksi,
        'trenBulanan' => $trenBulanan,
        'pendapatanPerStudio' => $pendapatanPerStudio,
        'monthName' => $months[$selectedMonth],
        'currentYear' => $currentYear,
        'years' => $years,
        'selectedYear' => $selectedYear,
        'selectedMonth' => $selectedMonth,
        'months' => $months
    ]);
}

    /**
     * Fill in missing months with zero values
     */
    protected function fillMissingMonths($data, $startMonth, $endMonth)
    {
        $result = collect();
        
        for ($month = $startMonth; $month <= $endMonth; $month++) {
            $found = $data->firstWhere('bulan_num', $month);
            
            $result->push($found ?: [
                'bulan' => Carbon::create()->month($month)->translatedFormat('M'),
                'total' => 0,
                'bulan_num' => $month
            ]);
        }
        
        return $result;
    }
}