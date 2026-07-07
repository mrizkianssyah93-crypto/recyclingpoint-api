<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
{
    $users = User::when(

        $request->search,

        function ($query) use ($request) {

            $query->where(
                'nama',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'username',
                'like',
                '%' . $request->search . '%'
            );

        }

    )

    ->latest()

    ->paginate(10);

    return view(
        'users.index',
        compact('users')
    );
}
public function store(Request $request)
{
    $request->validate([

        'nama' => 'required|max:255',

        'username' => 'required|unique:users,username|max:255',

        'password' => 'required|min:4',

        'role' => 'required',

        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

    ]);

        $foto = null;

if ($request->hasFile('foto')) {

    $foto = $request
        ->file('foto')
        ->store('users', 'public');

}

DB::table('users')->insert([

    'nama' => $request->nama,

    'username' => $request->username,

    'password' => Hash::make($request->password),

    'role' => $request->role,

    'poin' => 0,

    'foto' => $foto,

    'created_at' => now(),

    'updated_at' => now(),

]);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
$request->validate([

    'nama' => 'required|max:255',

    'username' => 'required|max:255',

    'role' => 'required',

    'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

]);

        $user = User::findOrFail($id);

        $data = [

            'nama' => $request->nama,

            'username' => $request->username,

            'role' => $request->role,

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
            ->store('users', 'public');
}

$user->update($data);

        return redirect()->back()
            ->with(
                'success',
                'User updated successfully'
            );
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back();
    }
}
