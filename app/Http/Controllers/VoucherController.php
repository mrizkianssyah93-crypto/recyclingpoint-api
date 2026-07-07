<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use App\Models\PointRedemption;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER REDEEM PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $vouchers = Voucher::all();

        return view(
            'vouchers.index',
            compact('vouchers')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAGEMENT PAGE
    |--------------------------------------------------------------------------
    */

public function management()
{
    $vouchers = Voucher::all();

    return view(
        'vouchers.management',
        compact('vouchers')
    );
}
    /*
    |--------------------------------------------------------------------------
    | STORE VOUCHER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        Voucher::create([

            'nama' => $request->nama,

            'kategori' => $request->kategori,

            'poin' => $request->poin

        ]);

        return back()->with(
            'success',
            'Voucher created successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE VOUCHER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        Voucher::findOrFail($id)
            ->update([

                'nama' => $request->nama,

                'kategori' => $request->kategori,

                'poin' => $request->poin

            ]);

        return back()->with(
            'success',
            'Voucher updated successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE VOUCHER
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        Voucher::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Voucher deleted successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REDEEM
    |--------------------------------------------------------------------------
    */

    public function redeem($id)
    {
        $user = auth()->user();

        $voucher = Voucher::findOrFail($id);

        if ($user->poin < $voucher->poin)
        {
            return back()->with(
                'error',
                'Not enough points'
            );
        }

        User::where(
            'id',
            $user->id
        )->update([

            'poin' =>
            $user->poin - $voucher->poin

        ]);

        PointRedemption::create([

            'user_id' => $user->id,

            'voucher_id' => $voucher->id,

            'poin_used' => $voucher->poin

        ]);

        return back()->with(
            'success',
            'Voucher redeemed successfully'
        );
    }
}