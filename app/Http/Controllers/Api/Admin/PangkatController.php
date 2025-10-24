<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pangkat;

class PangkatController extends Controller
{
    public function index()
    {
        $pangkats = Pangkat::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar semua pangkat',
            'data' => $pangkats,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pangkat' => 'required|string|max:255',
            'golongan' => 'nullable|string|max:50',
            'ruang' => 'nullable|string|max:50',
        ]);

        $pangkat = Pangkat::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pangkat berhasil ditambahkan',
            'data' => $pangkat,
        ], 201);
    }

    public function show($id)
    {
        $pangkat = Pangkat::find($id);

        if (!$pangkat) {
            return response()->json([
                'success' => false,
                'message' => 'Data pangkat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data pangkat',
            'data' => $pangkat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pangkat = Pangkat::find($id);

        if (!$pangkat) {
            return response()->json([
                'success' => false,
                'message' => 'Data pangkat tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nama_pangkat' => 'required|string|max:255',
            'golongan' => 'nullable|string|max:50',
            'ruang' => 'nullable|string|max:50',
        ]);

        $pangkat->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pangkat berhasil diperbarui',
            'data' => $pangkat,
        ]);
    }

    public function destroy($id)
    {
        $pangkat = Pangkat::find($id);

        if (!$pangkat) {
            return response()->json([
                'success' => false,
                'message' => 'Data pangkat tidak ditemukan',
            ], 404);
        }

        $pangkat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pangkat berhasil dihapus',
        ]);
    }
}
