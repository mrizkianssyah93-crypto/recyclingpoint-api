<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StoreTransaction;
use App\Models\WasteCategory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;

        $transactions = collect();
        $users = collect();
        $wasteCategories = collect();

        if ($type == 'transaction') {

            $transactions = StoreTransaction::with([
                'user',
                'category'
            ])
            ->latest()
            ->get();
        }

        if ($type == 'points') {

            $users = User::where(
                'role',
                'user'
            )->get();
        }

        if ($type == 'waste') {

            $wasteCategories = WasteCategory::all();
        }

        return view(
            'reports.index',
            compact(
                'type',
                'transactions',
                'users',
                'wasteCategories'
            )
        );
    }

    public function exportExcel(Request $request)
    {
        $type = $request->type;

        $filename =
            $type .
            '_report_' .
            date('YmdHis') .
            '.csv';

        $headers = [

            'Content-Type' =>
                'text/csv',

            'Content-Disposition' =>
                "attachment; filename={$filename}",

        ];

        $callback = function () use ($type) {

            $file = fopen(
                'php://output',
                'w'
            );

            if ($type == 'transaction')
            {
                fputcsv($file, [

                    'User',
                    'Category',
                    'Weight',
                    'Total Price',
                    'Points',
                    'Date'

                ]);

                $transactions =
                    StoreTransaction::with([
                        'user',
                        'category'
                    ])->get();

                foreach ($transactions as $item)
                {
                    fputcsv($file, [

                        $item->user->nama ?? '-',
                        $item->category->nama_kategori ?? '-',
                        $item->berat,
                        $item->total_harga,
                        $item->total_poin,
                        $item->created_at

                    ]);
                }
            }

            if ($type == 'points')
            {
                fputcsv($file, [

                    'Name',
                    'Username',
                    'Points'

                ]);

                foreach (
                    User::where('role','user')->get()
                    as $user
                )
                {
                    fputcsv($file, [

                        $user->nama,
                        $user->username,
                        $user->poin

                    ]);
                }
            }

            if ($type == 'waste')
            {
                fputcsv($file, [

                    'Category',
                    'Points Per KG'

                ]);

                foreach (
                    WasteCategory::all()
                    as $item
                )
                {
                    fputcsv($file, [

                        $item->nama_kategori,
                        $item->poin_per_kg

                    ]);
                }
            }

            fclose($file);
        };

        return response()
            ->stream(
                $callback,
                200,
                $headers
            );
    }
}