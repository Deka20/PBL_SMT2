<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetOtp;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $email = $request->email;

        // Hapus OTP lama untuk email ini
        DB::table('password_resets_otp')->where('email', $email)->delete();

        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Simpan OTP ke database
        DB::table('password_resets_otp')->insert([
            'email' => $email,
            'otp' => $otp,
            'created_at' => Carbon::now(),
            'expires_at' => $expiresAt,
        ]);

        try {
            // Kirim OTP via email
            Mail::to($email)->send(new PasswordResetOtp($otp));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim OTP ke ' . $email . ': ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim kode OTP. Silakan coba lagi nanti.']);
        }

        // Simpan email di session untuk verifikasi
        $request->session()->put('email_for_otp_verification', $email);

        return redirect()->route('password.verify.form')
            ->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function showVerifyForm(Request $request)
    {
        // Periksa apakah ada email di session
        if (!$request->session()->has('email_for_otp_verification')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session telah berakhir. Silakan mulai proses reset password dari awal.']);
        }

        $email = $request->session()->get('email_for_otp_verification');
        
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        // Periksa apakah email di session cocok dengan email yang dikirim
        $sessionEmail = $request->session()->get('email_for_otp_verification');
        
        if (!$sessionEmail || $request->email !== $sessionEmail) {
            return back()->withErrors(['email' => 'Email tidak cocok dengan proses verifikasi.'])
                        ->withInput($request->only('email'));
        }

        // Periksa OTP di database
        $otpRecord = DB::table('password_resets_otp')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.'])
                        ->withInput($request->only('email'));
        }

        // Periksa apakah OTP sudah expired
        if (Carbon::parse($otpRecord->expires_at)->isPast()) {
            // Hapus OTP yang expired
            DB::table('password_resets_otp')->where('email', $request->email)->delete();
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa. Silakan minta OTP baru.'])
                        ->withInput($request->only('email'));
        }

        // OTP valid, hapus dari database
        DB::table('password_resets_otp')->where('email', $request->email)->delete();

        // Tandai email sudah diverifikasi
        $request->session()->put('otp_verified_for_reset', $request->email);
        $request->session()->forget('email_for_otp_verification');

        return redirect()->route('password.reset.form')
            ->with('status', 'OTP berhasil diverifikasi. Silakan atur kata sandi baru Anda.');
    }

    public function showResetForm(Request $request)
    {
        // Periksa apakah ada email yang sudah diverifikasi di session
        if (!$request->session()->has('otp_verified_for_reset')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Akses tidak sah. Silakan mulai proses reset password dari awal.']);
        }

        $email = $request->session()->get('otp_verified_for_reset');
        
        // Jika ada email parameter di URL, pastikan cocok dengan session
        if ($request->has('email') && $request->email !== $email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Email tidak cocok dengan proses verifikasi.']);
        }

        return view('auth.reset-password', compact('email'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Periksa apakah email sudah diverifikasi di session
        $sessionEmail = $request->session()->get('otp_verified_for_reset');
        
        if (!$sessionEmail || $request->email !== $sessionEmail) {
            return back()->withErrors(['email' => 'Proses verifikasi OTP belum selesai atau tidak valid.']);
        }

        // Update password user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Pengguna tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus session verifikasi
        $request->session()->forget('otp_verified_for_reset');

        return redirect()->route('login')
            ->with('status', 'Kata sandi berhasil direset. Silakan login dengan kata sandi baru Anda.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $email = $request->email;
        $sessionEmail = $request->session()->get('email_for_otp_verification');

        if (!$sessionEmail || $email !== $sessionEmail) {
            return back()->withErrors(['email' => 'Email tidak cocok dengan proses verifikasi.']);
        }

        // Periksa apakah boleh kirim ulang (cooldown 1 menit)
        $lastOtp = DB::table('password_resets_otp')
            ->where('email', $email)
            ->first();

        if ($lastOtp && Carbon::parse($lastOtp->created_at)->addMinute()->isFuture()) {
            $remaining = Carbon::parse($lastOtp->created_at)->addMinute()->diffInSeconds(Carbon::now());
            return back()->withErrors(['email' => "Tunggu {$remaining} detik sebelum mengirim ulang OTP."]);
        }

        // Hapus OTP lama
        DB::table('password_resets_otp')->where('email', $email)->delete();

        // Generate OTP baru
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Simpan OTP baru
        DB::table('password_resets_otp')->insert([
            'email' => $email,
            'otp' => $otp,
            'created_at' => Carbon::now(),
            'expires_at' => $expiresAt,
        ]);

        try {
            Mail::to($email)->send(new PasswordResetOtp($otp));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim ulang OTP ke ' . $email . ': ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim ulang kode OTP. Silakan coba lagi nanti.']);
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}