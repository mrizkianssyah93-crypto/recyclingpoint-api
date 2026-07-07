<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $identifier = trim($request->identifier);

        /*
        |--------------------------------------------------------------------------
        | REGISTER VIA EMAIL
        |--------------------------------------------------------------------------
        */

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {

            if (User::where('email', $identifier)->exists()) {

                return back()->withErrors([
                    'identifier' => 'Email sudah terdaftar.'
                ]);
            }

            $code = rand(100000, 999999);

            $user = User::create([
                'nama' => explode('@', $identifier)[0],
                'username' => explode('@', $identifier)[0] . rand(100, 999),
                'email' => $identifier,
                'password' => Hash::make($request->password),
                'verification_code' => $code,
                'role' => 'user',
                'poin' => 0,
                'status' => 1,
            ]);

            Mail::to($identifier)->send(
                new VerificationCodeMail($code)
            );

            return view('auth.verify-code', [
                'user' => $user
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | REGISTER VIA NO HP
        |--------------------------------------------------------------------------
        */

        if (User::where('no_hp', $identifier)->exists()) {

            return back()->withErrors([
                'identifier' => 'Nomor HP sudah terdaftar.'
            ]);
        }

        User::create([
            'nama' => $identifier,
            'username' => 'user' . rand(10000, 99999),
            'no_hp' => $identifier,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'poin' => 0,
            'status' => 1,
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login.'
            );
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'code' => 'required'
        ]);

        $user = User::find($request->user_id);

        if (!$user) {

            return back()->withErrors([
                'code' => 'User tidak ditemukan.'
            ]);
        }

        if ($user->verification_code != $request->code) {

            return back()->withErrors([
                'code' => 'Kode verifikasi salah.'
            ]);
        }

        $user->update([
            'verification_code' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Email berhasil diverifikasi. Silakan login.'
            );
    }
}