<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\PointRedemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    /**
     * Daftar Voucher
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('poin')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar voucher berhasil diambil.',
            'data' => $vouchers
        ]);
    }

    /**
     * Redeem Voucher
     */
   public function redeem(Request $request)
{
    try {

        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id'
        ]);

        $user = $request->user();

        $voucher = Voucher::findOrFail($request->voucher_id);

        if ($user->poin < $voucher->poin) {

            return response()->json([
                'success' => false,
                'message' => 'Poin tidak mencukupi.'
            ], 400);

        }

        DB::transaction(function () use ($user, $voucher) {

            PointRedemption::create([

                'user_id' => $user->id,

                'voucher_id' => $voucher->id,

                'poin_used' => $voucher->poin

            ]);

            $user->decrement('poin', $voucher->poin);

        });

        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil ditukarkan.'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => basename($e->getFile())
        ],500);

    }
}

    /**
     * History Redeem
     */
    public function history(Request $request)
    {
        $history = PointRedemption::with('voucher')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat redeem berhasil diambil.',
            'data' => $history
        ]);
    }
}