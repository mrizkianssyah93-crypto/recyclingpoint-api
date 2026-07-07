<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view(
            'profile.edit',
            [
                'user' => Auth::user()
            ]
        );
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([

            'nama' => 'required|max:255',

            'username' =>
                'required|max:255|unique:users,username,' . $user->id,

            'password' =>
                'nullable|min:4',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        $data = [

            'nama' => $request->nama,

            'username' => $request->username,

        ];

        if (!empty($request->password))
        {
            $data['password'] =
                Hash::make($request->password);
        }

        if ($request->hasFile('foto'))
        {
            if ($user->foto)
            {
                Storage::disk('public')
                    ->delete($user->foto);
            }

            $data['foto'] =
                $request
                    ->file('foto')
                    ->store(
                        'users',
                        'public'
                    );
        }

        $user->update($data);

        return redirect()
            ->back()
            ->with(
                'success',
                'Profile updated successfully'
            );
    }
}