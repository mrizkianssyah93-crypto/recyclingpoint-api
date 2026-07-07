<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteCategory extends Model
{
    protected $table = 'waste_categories';

    protected $fillable = [

        'main_category',

        'nama_kategori',

        'poin_per_kg'

    ];
}