<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    protected $fillable = [

        'user_id',

        'waste_category_id',

        'waste_bank_name',

        'alamat_lengkap',

        'nomor_hp',

        'estimasi_berat',

        'tanggal_pickup',

        'pickup_time',

        'distance_km',
'estimasi_poin',
        'ongkir',

        'status'
        

    ];

    /*
    |--------------------------------------------------------------------------
    | CATEGORY RELATION
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            \App\Models\WasteCategory::class,
            'waste_category_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | USER RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'user_id'
        );
    }
}