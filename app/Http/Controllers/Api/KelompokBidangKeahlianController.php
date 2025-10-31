<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KelompokBidangKeahlian;

class KelompokBidangKeahlianController extends Controller
{
    public function index()
    {
        $kelompoks = KelompokBidangKeahlian::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua kelompok bidang keahlian',
            'data' => $kelompoks,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kelompok = KelompokBidangKeahlian::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok bidang keahlian berhasil ditambahkan',
            'data' => $kelompok,
        ], 201);
    }

    public function show($id)
    {
        $kelompok = KelompokBidangKeahlian::find($id);

        if (!$kelompok) {
            return response()->json([
                'success' => false,
                'message' => 'Data kelompok bidang keahlian tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data kelompok bidang keahlian',
            'data' => $kelompok,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelompok = KelompokBidangKeahlian::find($id);

        if (!$kelompok) {
            return response()->json([
                'success' => false,
                'message' => 'Data kelompok bidang keahlian tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kelompok->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok bidang keahlian berhasil diperbarui',
            'data' => $kelompok,
        ]);
    }

    public function destroy($id)
    {
        $kelompok = KelompokBidangKeahlian::find($id);

        if (!$kelompok) {
            return response()->json([
                'success' => false,
                'message' => 'Data kelompok bidang keahlian tidak ditemukan',
            ], 404);
        }

        $kelompok->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok bidang keahlian berhasil dihapus',
        ]);
    }
}
