<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return match(Auth::user()->role) {
            'admin' => route('admin.dashboard'),
            'pelanggan' => route('pages.home'),
            default => '/'
        };
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectTo();
        }

        return view('auth.masuk');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Tentukan apakah login menggunakan email atau nama pengguna
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama_pengguna';
        
        // Cek apakah email/nama pengguna dan password valid
        $user = \App\Models\User::where($fieldType, $request->login)->first();
    
        if (!$user) {
            return redirect()->back()
                ->with('error', 'Email/Nama Pengguna tidak ditemukan.')
                ->withInput();
        }
    
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password salah.')
                ->withInput();
        }
    
        // Jika berhasil, login pengguna
        Auth::login($user, $request->remember);
    
        // Regenerasi sesi untuk mencegah serangan session fixation
        $request->session()->regenerate();
    
        // Redirect ke halaman yang dituju
        return redirect()->intended($this->redirectTo());
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}