<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreTransaction extends Model
{
    protected $fillable = [

        'user_id',

        'waste_category_id',

        'berat',

        'total_harga',

        'total_poin'

    ];

    /*
    |--------------------------------------------------------------------------
    | USER RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY RELATION
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            WasteCategory::class,
            'waste_category_id'
        );
    }
}