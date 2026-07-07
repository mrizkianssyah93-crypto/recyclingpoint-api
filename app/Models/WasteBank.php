<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteBank extends Model
{
protected $fillable = [
    'nama',
    'alamat',
    'status',
    'latitude',
    'longitude'
];
}