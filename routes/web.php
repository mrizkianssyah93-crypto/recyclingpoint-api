<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\WasteCategory;
use App\Models\StoreTransaction;
use App\Models\PickupRequest;
use App\Models\WasteBank;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WasteCategoryController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\StoreTransactionController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\WasteBankController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| GOOGLE AUTH
|--------------------------------------------------------------------------
*/

Route::get(
    '/auth/google',
    [SocialAuthController::class, 'redirectGoogle']
);

Route::get(
    '/auth/google/callback',
    [SocialAuthController::class, 'callbackGoogle']
);

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $categories = WasteCategory::all();

    return view(
        'welcome',
        compact('categories')
    );

});

Route::get('/waste-prices', function () {

    $categories = WasteCategory::all();

    return view(
        'public.waste-prices',
        compact('categories')
    );

})->name('waste-prices');

Route::get('/waste-banks', function () {

    $wasteBanks = WasteBank::where('status', 1)->get();

    return view(
        'public.waste-banks',
        compact('wasteBanks')
    );

})->name('waste-banks');

/*
|--------------------------------------------------------------------------
| ALL AUTH USERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('backend')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

$totalUsers = User::count();

$totalCategories = WasteCategory::count();

$totalTransactions = StoreTransaction::count();

$totalPickups = PickupRequest::count();

$totalWasteBanks = WasteBank::count();

        return match(Auth::user()->role) {

            /*
            |--------------------------------------------------------------------------
            | ADMIN
            |--------------------------------------------------------------------------
            */

'admin' => view('dashboard.admin', compact(
    'totalUsers',
    'totalCategories',
    'totalTransactions',
    'totalPickups',
    'totalWasteBanks'
)),

            /*
            |--------------------------------------------------------------------------
            | OPERATION
            |--------------------------------------------------------------------------
            */

            'operation' => view('dashboard.operation', [

                'pending' => PickupRequest::where(
                    'status',
                    'pending'
                )->count(),

                'process' => PickupRequest::where(
                    'status',
                    'process'
                )->count(),

                'pickups' => PickupRequest::with('user')

                ->whereIn('status', [

                    'pending',

                    'process'

                ])

                ->latest()

                ->get()

            ]),

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            default => view('dashboard.user')

        };

    })->name('dashboard');

   /*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::get(
    '/profile',
    [ProfileController::class, 'edit']
)->name('profile.edit');

Route::put(
    '/profile/update',
    [ProfileController::class, 'update']
)->name('profile.update');

/*
|--------------------------------------------------------------------------
| HISTORY
|--------------------------------------------------------------------------
*/
    /*
    |--------------------------------------------------------------------------
    | HISTORY
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/history',
        [StoreTransactionController::class, 'history']
    )->name('history');

    /*
    |--------------------------------------------------------------------------
    | PICKUP REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pickup-requests',
        [PickupRequestController::class, 'index']
    )->name('pickup-requests');

    Route::post(
        '/pickup-requests/store',
        [PickupRequestController::class, 'store']
    )->name('pickup-requests.store');

    /*
    |--------------------------------------------------------------------------
    | OPERATOR PICKUP ACTION
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/pickup/process/{id}',
        [PickupRequestController::class, 'process']
    )->name('pickup.process');

    Route::post(
        '/pickup/complete/{id}',
        [PickupRequestController::class, 'complete']
    )->name('pickup.complete');

    /*
    |--------------------------------------------------------------------------
    | VOUCHERS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/vouchers',
        [VoucherController::class, 'index']
    )->name('vouchers');

    Route::post(
        '/vouchers/redeem/{id}',
        [VoucherController::class, 'redeem']
    )->name('vouchers.redeem');

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('backend')->group(function () {
Route::get(
    '/voucher-management',
    [VoucherController::class, 'management']
)->name('voucher-management');

Route::post(
    '/voucher-management/store',
    [VoucherController::class, 'store']
)->name('voucher-management.store');

Route::post(
    '/voucher-management/update/{id}',
    [VoucherController::class, 'update'
])->name('voucher-management.update');

Route::delete(
    '/voucher-management/delete/{id}',
    [VoucherController::class, 'destroy']
)->name('voucher-management.delete');
    Route::get(
        '/waste-categories',
        [WasteCategoryController::class, 'index']
    )->name('waste-categories');

    Route::post(
        '/waste-categories/store',
        [WasteCategoryController::class, 'store']
    )->name('waste-categories.store');

    Route::put(
        '/waste-categories/update/{id}',
        [WasteCategoryController::class, 'update']
    )->name('waste-categories.update');

    Route::delete(
        '/waste-categories/delete/{id}',
        [WasteCategoryController::class, 'destroy']
    )->name('waste-categories.delete');

    Route::get(
        '/users',
        [UserController::class, 'index']
    )->name('users');
Route::put(
    '/users/update/{id}',
    [UserController::class, 'update']
)->name('users.update');
    Route::post(
        '/users/store',
        [UserController::class, 'store']
    )->name('users.store');

    Route::delete(
        '/users/delete/{id}',
        [UserController::class, 'destroy']
    )->name('users.delete');
    
    Route::get(
    '/waste-bank-locations',
    [WasteBankController::class, 'index']
)->name('waste-bank-locations');

Route::post(
    '/waste-bank-locations/store',
    [WasteBankController::class, 'store']
)->name('waste-bank-locations.store');
Route::post(
    '/waste-bank-locations/deactivate/{id}',
    [WasteBankController::class, 'deactivate']
)->name('waste-bank-locations.deactivate');

Route::post(
    '/waste-bank-locations/activate/{id}',
    [WasteBankController::class, 'activate']
)->name('waste-bank-locations.activate');
Route::post(
    '/waste-bank-locations/update/{id}',
    [WasteBankController::class, 'update']
)->name('waste-bank-locations.update');
Route::delete(
    '/waste-bank-locations/delete/{id}',
    [WasteBankController::class, 'destroy']
)->name('waste-bank-locations.delete');
Route::get(
    '/reports',
    [ReportController::class, 'index']
)->name('reports');

Route::get(
    '/reports/export',
    [ReportController::class, 'exportExcel']
)->name('reports.export');
});

/*
|--------------------------------------------------------------------------
| ADMIN + OPERATION
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,operation'])->prefix('backend')->group(function () {

    Route::get(
        '/store-transactions',
        [StoreTransactionController::class, 'index']
    )->name('store-transactions');

    Route::post(
        '/store-transactions/store',
        [StoreTransactionController::class, 'store']
    )->name('store-transactions.store');

    Route::post(
    '/pickup/update-weight/{id}',
    [PickupRequestController::class, 'updateWeight']
)->name('pickup.updateWeight');

});

require __DIR__.'/auth.php';