<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Google\Client as GoogleClient;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login Mobile API (Stateless)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $stage = 'find_user';

        try {
            // Find user by username
            $user = User::where(
                'username',
                $credentials['username']
            )->first();

            $stage = 'check_password';

            // Verify password without creating a session
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Username atau password salah.',
                ], 401);
            }

            $stage = 'check_status';

            // Check user status
            if (isset($user->status) && !$user->status) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak aktif.',
                ], 403);
            }

            $stage = 'update_login';

            // Update login information when columns exist
            $user->failed_login_attempt = 0;
            $user->last_login_at = now();
            $user->save();

            $stage = 'delete_old_tokens';

            // Delete previous mobile tokens
            $user->tokens()->delete();

            $stage = 'create_token';

            // Create Sanctum token
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

        } catch (\Throwable $e) {

            Log::error('Mobile Login Error', [
                'stage' => $stage,
                'username' => $credentials['username'],
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Login processing failed.',
                'stage' => $stage,
            ], 500);
        }
    }

    /**
     * Google Login
     */
    public function googleLogin(Request $request)
    {
        $request->validate([
            'id_token' => ['required', 'string'],
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
                $user->google_id = $googleId;
                $user->save();
            }

            $user->last_login_at = now();
            $user->failed_login_attempt = 0;
            $user->save();

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

        } catch (\Throwable $e) {

            Log::error('Google Login Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Google login processing failed.',
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
