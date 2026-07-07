<?php

namespace App\Http\Controllers;

use App\Models\WasteBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WasteBankController extends Controller
{
    public function index()
    {
        $wasteBanks = WasteBank::latest()->get();

        return view(
            'waste-banks.index',
            compact('wasteBanks')
        );
    }

    public function store(Request $request)
    {
    $response = Http::get(
    'https://maps.googleapis.com/maps/api/geocode/json',
    [
        'address' => 'Jakarta Barat',
        'key' => env('GOOGLE_MAPS_API_KEY')
    ]
);

    $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ]);

        $response = Http::get(
    'https://maps.googleapis.com/maps/api/geocode/json',
    [
        'address' => $request->alamat,
        'key' => env('GOOGLE_MAPS_API_KEY')
    ]
);

$latitude = null;
$longitude = null;

if(
    $response->successful()
    &&
    isset($response['results'][0])
)
{
    $latitude =
        $response['results'][0]['geometry']['location']['lat'];

    $longitude =
        $response['results'][0]['geometry']['location']['lng'];
}

WasteBank::create([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'latitude' => $latitude,
    'longitude' => $longitude,
    'status' => 1
]);

        return back()->with(
            'success',
            'Waste Bank Location berhasil ditambahkan.'
        );
    }
public function deactivate($id)
{
    WasteBank::findOrFail($id)->update([
        'status' => 0
    ]);

    return back()->with(
        'success',
        'Location berhasil dinonaktifkan.'
    );
}

public function activate($id)
{
    WasteBank::findOrFail($id)->update([
        'status' => 1
    ]);

    return back()->with(
        'success',
        'Location berhasil diaktifkan.'
    );
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required'
    ]);

    $response = Http::get(
    'https://maps.googleapis.com/maps/api/geocode/json',
    [
        'address' => $request->alamat,
        'key' => env('GOOGLE_MAPS_API_KEY')
    ]
);

$latitude = null;
$longitude = null;

if(
    $response->successful()
    &&
    isset($response['results'][0])
)
{
    $latitude =
        $response['results'][0]['geometry']['location']['lat'];

    $longitude =
        $response['results'][0]['geometry']['location']['lng'];
}

WasteBank::findOrFail($id)->update([
    'nama' => $request->nama,
    'alamat' => $request->alamat,
    'latitude' => $latitude,
    'longitude' => $longitude
]);

    return back()->with(
        'success',
        'Location berhasil diupdate.'
    );
}

public function destroy($id)
{
    WasteBank::findOrFail($id)->delete();

    return back()->with(
        'success',
        'Waste Bank Location berhasil dihapus.'
    );
}
}