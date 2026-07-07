<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * ==========================================
     * GET PROFILE
     * ==========================================
     */
    public function profile(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diambil.',
            'data' => $request->user(),
        ]);
    }

    /**
     * ==========================================
     * UPDATE PROFILE
     * ==========================================
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = $request->user();

        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile berhasil diperbarui.',
            'data' => $user,
        ]);
    }

    /**
     * ==========================================
     * UPLOAD PHOTO
     * ==========================================
     */
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = $request->user();

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->storeAs(
                'profile',
                $filename,
                'public'
            );

            $user->photo = $filename;

            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Foto profile berhasil diperbarui.',
            'data' => $user,
        ]);
    }

    /**
     * ==========================================
     * CHANGE PASSWORD
     * ==========================================
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $user = $request->user();

        if (!Hash::check(
            $request->old_password,
            $user->password
        )) {

            return response()->json([
                'success' => false,
                'message' => 'Password lama salah.'
            ],400);
        }

        $user->password = Hash::make(
            $request->new_password
        );

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah.'
        ]);
    }
}