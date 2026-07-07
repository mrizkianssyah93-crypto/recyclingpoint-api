<?php

namespace App\Http\Controllers;

use App\Models\WasteCategory;
use Illuminate\Http\Request;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $categories = WasteCategory::latest()->get();

        return view('waste_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        WasteCategory::create([
            'nama_kategori' => $request->nama_kategori,
            'poin_per_kg' => $request->poin_per_kg,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $category = WasteCategory::findOrFail($id);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'poin_per_kg' => $request->poin_per_kg,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        WasteCategory::findOrFail($id)->delete();

        return redirect()->back();
    }
}