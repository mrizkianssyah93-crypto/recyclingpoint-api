<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WasteCategory;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $categories = WasteCategory::orderBy('nama_kategori')
            ->get([
                'id',
                'nama_kategori',
                'harga_per_kg',
                'poin_per_kg',
                'main_category'
            ]);

        return response()->json([

            'success' => true,

            'message' => 'Kategori sampah berhasil diambil.',

            'data' => $categories

        ]);
    }
}