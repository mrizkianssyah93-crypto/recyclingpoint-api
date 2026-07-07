<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\WasteCategory;

class PickupController extends Controller
{
    /**
     * Daftar Pickup User
     */
    public function index(Request $request)
    {
        $pickups = PickupRequest::with('category')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar pickup berhasil diambil.',
            'data' => $pickups
        ]);
    }

    /**
     * Detail Pickup
     */
    public function show(Request $request, $id)
    {
        $pickup = PickupRequest::with('category')
            ->where('user_id', $request->user()->id)
            ->find($id);

        if (!$pickup) {
            return response()->json([
                'success' => false,
                'message' => 'Pickup tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pickup
        ]);
    }

    /**
     * Buat Pickup Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'waste_category_id' => 'required|exists:waste_categories,id',
            'waste_bank_name'   => 'required|string|max:255',
            'alamat_lengkap'    => 'required|string',
            'nomor_hp'          => 'required|string|max:30',
            'tanggal_pickup'    => 'required|date',
            'pickup_time'       => 'required|string|max:50',
            'estimasi_berat'    => 'required|numeric|min:1',
            'distance_km'       => 'required|numeric|min:0'
        ]);

        $category = WasteCategory::findOrFail($request->waste_category_id);

        // Hitung ongkir
        $ongkir = $request->distance_km * 2000;

        // Hitung estimasi poin
        $estimasiPoin = $request->estimasi_berat * $category->poin_per_kg;

        $pickup = PickupRequest::create([

            'user_id'            => $request->user()->id,

            'waste_category_id'  => $request->waste_category_id,

            'waste_bank_name'    => $request->waste_bank_name,

            'alamat_lengkap'     => $request->alamat_lengkap,

            'nomor_hp'           => $request->nomor_hp,

            'tanggal_pickup'     => $request->tanggal_pickup,

            'pickup_time'        => $request->pickup_time,

            'estimasi_berat'     => $request->estimasi_berat,

            'distance_km'        => $request->distance_km,

            'ongkir'             => $ongkir,

            'estimasi_poin'      => $estimasiPoin,

            'status'             => 'pending'

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pickup berhasil dibuat.',
            'data' => $pickup
        ], 201);
    }

    /**
     * Update Pickup
     */
    public function update(Request $request, $id)
    {
        $pickup = PickupRequest::where('user_id', $request->user()->id)
            ->find($id);

        if (!$pickup) {
            return response()->json([
                'success' => false,
                'message' => 'Pickup tidak ditemukan.'
            ], 404);
        }

        if ($pickup->status != 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pickup yang sudah diproses tidak dapat diubah.'
            ], 400);
        }

        $pickup->update($request->only([
            'tanggal_pickup',
            'pickup_time',
            'alamat_lengkap',
            'nomor_hp',
            'catatan'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Pickup berhasil diperbarui.',
            'data' => $pickup
        ]);
    }

    /**
     * Batalkan Pickup
     */
    public function destroy(Request $request, $id)
    {
        $pickup = PickupRequest::where('user_id', $request->user()->id)
            ->find($id);

        if (!$pickup) {
            return response()->json([
                'success' => false,
                'message' => 'Pickup tidak ditemukan.'
            ], 404);
        }

        if ($pickup->status != 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pickup yang sudah diproses tidak dapat dibatalkan.'
            ], 400);
        }

        $pickup->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pickup berhasil dibatalkan.'
        ]);
    }
}