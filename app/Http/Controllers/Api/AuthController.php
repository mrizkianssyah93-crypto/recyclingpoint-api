<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Google\Client as GoogleClient;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login Mobile API
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.',
            ], 401);
        }

        $user = Auth::user();

        // Optional: hanya 1 token aktif
        $user->tokens()->delete();

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.',
            'data' => [
                'token' => $token,
                'user' => [
                    'id'       => $user->id,
                    'nama'     => $user->nama,
                    'username' => $user->username,
                    'email'    => $user->email,
                    'role'     => $user->role,
                    'poin'     => $user->poin,
                    'foto'     => $user->foto,
                    'no_hp'    => $user->no_hp,
                    'alamat'   => $user->alamat,
                ],
            ],
        ]);
    }

    /**
     * Google Login
     */
    public function googleLogin(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);

        try {

            $client = new GoogleClient([
                'client_id' => env('GOOGLE_CLIENT_ID'),
            ]);

            $payload = $client->verifyIdToken($request->id_token);

            if (!$payload) {
                return response()->json([
                    'success' => false,
                    'message' => 'Google token tidak valid.',
                ], 401);
            }

            $googleId = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'] ?? 'Google User';
            $picture = $payload['picture'] ?? null;

            // Cari user berdasarkan email
            $user = User::where('email', $email)->first();

            if (!$user) {

                $username = Str::slug(explode('@', $email)[0]);

                $originalUsername = $username;
                $counter = 1;

                while (User::where('username', $username)->exists()) {
                    $username = $originalUsername . $counter;
                    $counter++;
                }

                $user = User::create([
                    'nama'      => $name,
                    'username'  => $username,
                    'email'     => $email,
                    'google_id' => $googleId,
                    'password'  => Hash::make(Str::random(32)),
                    'role'      => 'user',
                    'status'    => 1,
                    'poin'      => 0,
                    'foto'      => $picture,
                ]);

            } else {

                $user->update([
                    'google_id' => $googleId,
                ]);
            }

            // Update informasi login
            $user->last_login_at = now();
            $user->failed_login_attempt = 0;
            $user->save();

            // Optional: hanya 1 token aktif
            $user->tokens()->delete();

            $token = $user->createToken('mobile-app')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Google berhasil.',
                'data' => [
                    'token' => $token,
                    'user' => [
                        'id'       => $user->id,
                        'nama'     => $user->nama,
                        'username' => $user->username,
                        'email'    => $user->email,
                        'role'     => $user->role,
                        'poin'     => $user->poin,
                        'foto'     => $user->foto,
                        'no_hp'    => $user->no_hp,
                        'alamat'   => $user->alamat,
                    ],
                ],
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);

        }
    }

    /**
     * Logout Mobile API
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil.',
        ]);
    }
}