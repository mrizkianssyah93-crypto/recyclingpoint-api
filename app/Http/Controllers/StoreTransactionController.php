<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WasteCategory;
use App\Models\StoreTransaction;
use App\Models\PickupRequest;
use Illuminate\Http\Request;

class StoreTransactionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STORE TRANSACTION PAGE
    |--------------------------------------------------------------------------
    */

public function index()
{
    $transactions = StoreTransaction::with([
        'user',
        'category'
    ])->latest()->get();

return view(
    'store_transactions.index',
    compact(
        'transactions'
    )
);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE TRANSACTION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $category = WasteCategory::findOrFail(
            $request->waste_category_id
        );

        /*
        |--------------------------------------------------------------------------
        | TOTAL PRICE
        |--------------------------------------------------------------------------
        */

        $totalHarga =
            $category->harga_per_kg * $request->berat;

        /*
        |--------------------------------------------------------------------------
        | POINT CONVERSION
        |--------------------------------------------------------------------------
        |
        | Rp 1000 = 10 Point
        | 1 Point = Rp 100
        |
        */

        $totalPoin =
            $totalHarga / 100;

        /*
        |--------------------------------------------------------------------------
        | CREATE TRANSACTION
        |--------------------------------------------------------------------------
        */

        StoreTransaction::create([

            'user_id' => $request->user_id,

            'waste_category_id' => $request->waste_category_id,

            'berat' => $request->berat,

            'total_harga' => $totalHarga,

            'total_poin' => $totalPoin,

        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE USER POINT
        |--------------------------------------------------------------------------
        */

        $user = User::findOrFail(
            $request->user_id
        );

        $user->increment(
            'poin',
            $totalPoin
        );

        return redirect()

            ->back()

            ->with(
                'success',
                'Transaction successfully added'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSACTION HISTORY
    |--------------------------------------------------------------------------
    */

    public function history()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        if($user->role == 'user')
        {
            $transactions = StoreTransaction::with([

                'user',

                'category'

            ])

            ->where(
                'user_id',
                $user->id
            )

            ->latest()

            ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN / OPERATOR
        |--------------------------------------------------------------------------
        */

        else
        {
            $transactions = StoreTransaction::with([

                'user',

                'category'

            ])

            ->latest()

            ->get();
        }

        return view(
            'store_transactions.history',
            compact('transactions')
        );
    }
}