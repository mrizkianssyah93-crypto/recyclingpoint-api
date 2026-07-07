<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\StoreTransaction;
use App\Models\Voucher;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $pendingPickup = PickupRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $completedPickup = PickupRequest::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $totalTransaction = StoreTransaction::where('user_id', $user->id)
            ->count();

        $voucherAvailable = Voucher::count();

        $recentPickup = PickupRequest::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get([
                'id',
                'tanggal_pickup',
                'status',
                'estimasi_berat',
                'estimasi_poin'
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Dashboard berhasil diambil.',
            'data' => [

                'user' => [
                    'nama' => $user->nama,
                    'foto' => $user->foto,
                    'poin' => $user->poin,
                ],

                'summary' => [
                    'pending_pickup' => $pendingPickup,
                    'completed_pickup' => $completedPickup,
                    'total_transaction' => $totalTransaction,
                    'voucher_available' => $voucherAvailable,
                ],

                'recent_pickups' => $recentPickup,

            ]
        ]);
    }
}