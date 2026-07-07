<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WasteBank;

class WasteBankController extends Controller
{
    public function index()
    {
        $banks = WasteBank::select(
                'id',
                'nama',
                'alamat',
                'latitude',
                'longitude'
            )
            ->where('status', 1)
            ->orderBy('nama')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar bank sampah berhasil diambil.',
            'data' => $banks
        ]);
    }
}