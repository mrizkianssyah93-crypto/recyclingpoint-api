<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\WasteCategory;
use App\Models\StoreTransaction;
use App\Models\User;
use App\Models\WasteBank;

class PickupRequestController extends Controller
{
 public function index()
{
    $categories = WasteCategory::all();

    $wasteBanks = \App\Models\WasteBank::where(
        'status',
        1
    )->get();

    if(auth()->user()->role == 'user')
    {
        $requests = PickupRequest::with([
            'category',
            'user'
        ])

        ->where(
            'user_id',
            auth()->user()->id
        )

        ->whereIn('status', [

            'pending',

            'process'

        ])

        ->latest()

        ->get();
    }
    else
    {
        $requests = PickupRequest::with([
            'category',
            'user'
        ])

        ->whereIn('status', [

            'pending',

            'process'

        ])

        ->latest()

        ->get();
    }

    return view(
        'pickup_requests.index',
        compact(
            'categories',
            'requests',
            'wasteBanks'
        )
    );
}

    /*
    |--------------------------------------------------------------------------
    | STORE PICKUP
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $distance = $request->distance_km;

        $ongkir = 0;

        /*
        |--------------------------------------------------------------------------
        | DELIVERY FEE
        |--------------------------------------------------------------------------
        */

        if($request->estimasi_berat > 25)
        {
            $ongkir = $distance * 3000;
        }

        PickupRequest::create([

            'user_id' => auth()->user()->id,

            'waste_category_id' => $request->waste_category_id,

            'waste_bank_name' => $request->waste_bank_name,

            'alamat_lengkap' => $request->alamat_lengkap,

            'nomor_hp' => $request->nomor_hp,

            'estimasi_berat' => $request->estimasi_berat,

            'tanggal_pickup' => $request->tanggal_pickup,

            'pickup_time' => $request->pickup_time,

            'distance_km' => $distance,

            'ongkir' => $ongkir,

            'status' => 'pending'

        ]);

        return redirect()

            ->back()

            ->with(
                'success',
                'Pickup request submitted successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESS PICKUP
    |--------------------------------------------------------------------------
    */

    public function process($id)
    {
        $pickup = PickupRequest::findOrFail($id);

        $pickup->status = 'process';

        $pickup->save();

        return redirect()

            ->back()

            ->with(
                'success',
                'Pickup request is now being processed'
            );
    }

    /*
|--------------------------------------------------------------------------
| COMPLETE PICKUP
|--------------------------------------------------------------------------
*/

public function complete($id)
{
    $pickup = PickupRequest::with([
        'category'
    ])->findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    if(!$pickup->category)
    {
        return redirect()

            ->back()

            ->with(
                'error',
                'This pickup request has no waste category'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

    $pickup->status = 'completed';

    $pickup->save();

    /*
    |--------------------------------------------------------------------------
    | TOTAL PRICE
    |--------------------------------------------------------------------------
    |
    | Rp 1000 = 10 Point
    | 1 Point = Rp 100
    |
    */

    $totalHarga =
        $pickup->category->poin_per_kg
        * $pickup->estimasi_berat;

    /*
    |--------------------------------------------------------------------------
    | POINT CONVERSION
    |--------------------------------------------------------------------------
    */

    $totalPoin =
        $totalHarga / 100;

    /*
    |--------------------------------------------------------------------------
    | CREATE STORE TRANSACTION
    |--------------------------------------------------------------------------
    */

    StoreTransaction::create([

        'user_id' => $pickup->user_id,

        'waste_category_id' => $pickup->waste_category_id,

        'berat' => $pickup->estimasi_berat,

        'total_harga' => $totalHarga,

        'total_poin' => $totalPoin,

    ]);

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER POINT
    |--------------------------------------------------------------------------
    */

    $user = User::findOrFail(
        $pickup->user_id
    );

    $user->increment(
        'poin',
        $totalPoin
    );

    return redirect()

        ->back()

        ->with(
            'success',
            'Pickup request completed successfully'
        );
}

/*
|--------------------------------------------------------------------------
| UPDATE WEIGHT
|--------------------------------------------------------------------------
*/

public function updateWeight(Request $request, $id)
{
    $pickup = PickupRequest::findOrFail($id);

    $pickup->estimasi_berat =
        $request->estimasi_berat;

    $pickup->save();

    return redirect()

        ->back()

        ->with(
            'success',
            'Pickup weight updated successfully'
        );
}
}