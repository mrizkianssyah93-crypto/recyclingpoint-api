
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

        $stage = 'auth_attempt';

        try {
            // Authenticate user
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Username atau password salah.',
                ], 401);
            }

            // Get authenticated user
            $stage = 'get_user';
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('Authenticated user not found.');
            }

            // Delete previous tokens
            $stage = 'delete_old_tokens';
            $user->tokens()->delete();

            // Create new Sanctum token
            $stage = 'create_token';
            $token = $user->createToken('mobile-app')->plainTextToken;

            // Return login response
            $stage = 'return_response';

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
            ], 500);
        }
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

            // Find user by email
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

            // Update login information
            $user->last_login_at = now();
            $user->failed_login_attempt = 0;
            $user->save();

            // Delete previous tokens
            $user->tokens()->delete();

            // Create new Sanctum token
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
