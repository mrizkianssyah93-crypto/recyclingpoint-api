<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;

class HistoryController extends Controller
{
    public function pickup(Request $request)
{
    $history = PickupRequest::with('category')
        ->where('user_id', $request->user()->id)
        ->latest()
        ->get()
        ->map(function ($item) {

            $hargaPerKg = $item->category?->harga_per_kg ?? 0;

            $estimatedValue =
                $hargaPerKg * $item->estimasi_berat;

            $netValue =
                $estimatedValue - $item->ongkir;

            return [
                'id' => $item->id,
                'status' => $item->status,
                'waste_bank_name' => $item->waste_bank_name,
                'estimasi_berat' => $item->estimasi_berat,
                'tanggal_pickup' => $item->tanggal_pickup,
                'pickup_time' => $item->pickup_time,
                'distance_km' => $item->distance_km,
                'ongkir' => $item->ongkir,

                'estimated_value' => $estimatedValue,
                'net_value' => $netValue,

                'category' => [
                    'nama_kategori' =>
                        $item->category?->nama_kategori
                ],
            ];
        });

    return response()->json([
        'success' => true,
        'message' => 'Riwayat pickup berhasil diambil.',
        'data' => $history,
    ]);
}
}