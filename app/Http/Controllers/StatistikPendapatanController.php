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
    $currentDate = Carbon::now();
    $currentYear = $currentDate->year;
    $currentMonth = $currentDate->month;

    $selectedYear = (int)$request->input('tahun', $currentYear);
    $selectedMonth = (int)$request->input('bulan', $currentMonth);

    $years = range($currentYear, $currentYear - 4);

    $months = [];
    for ($i = 1; $i <= 12; $i++) {
        $months[$i] = Carbon::create()->month($i)->translatedFormat('F');
    }

    $baseQuery = TotalPenghasilan::query()
        ->whereYear('created_at', $selectedYear)
        ->whereMonth('created_at', $selectedMonth);

    $totalPendapatan = $baseQuery->sum('total_harga');
    $jumlahTransaksi = $baseQuery->count();
    $rataTransaksi = $jumlahTransaksi > 0 ? $totalPendapatan / $jumlahTransaksi : 0;

    $monthlyData = TotalPenghasilan::whereYear('created_at', $selectedYear)
        ->selectRaw('MONTH(created_at) as bulan_num, SUM(total_harga) as total')
        ->groupByRaw('MONTH(created_at)')
        ->orderByRaw('MONTH(created_at) ASC')
        ->get()
        ->keyBy('bulan_num');

    $trenBulanan = collect();
    for ($month = 1; $month <= 12; $month++) {
        $monthData = $monthlyData->get($month, (object)['bulan_num' => $month, 'total' => 0]);
        $trenBulanan->push([
            'bulan' => Carbon::create()->month($month)->translatedFormat('M'),
            'total' => $monthData->total,
            'bulan_num' => $month
        ]);
    }

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