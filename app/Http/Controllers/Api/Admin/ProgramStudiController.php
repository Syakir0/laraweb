<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramStudiController extends Controller
{
    /**
     * Tampilkan semua Program Studi.
     */
    public function index()
    {
        $programStudis = ProgramStudi::withCount('mahasiswas')->get();

        return response()->json([
            'success' => true,
            'data' => $programStudis,
        ]);
    }

    /**
     * Simpan Program Studi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_studi' => 'required|string|max:100|unique:program_studis,program_studi',
        ]);

        $programStudi = ProgramStudi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Program studi berhasil ditambahkan.',
            'data' => $programStudi,
        ], Response::HTTP_CREATED);
    }

    /**
     * Tampilkan detail satu Program Studi.
     */
    public function show($id)
    {
        $programStudi = ProgramStudi::with('mahasiswas')->find($id);

        if (!$programStudi) {
            return response()->json([
                'success' => false,
                'message' => 'Program studi tidak ditemukan.',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $programStudi,
        ]);
    }

    /**
     * Update data Program Studi.
     */
    public function update(Request $request, $id)
    {
        $programStudi = ProgramStudi::find($id);

        if (!$programStudi) {
            return response()->json([
                'success' => false,
                'message' => 'Program studi tidak ditemukan.',
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'program_studi' => 'required|string|max:100|unique:program_studis,program_studi,' . $id,
        ]);

        $programStudi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Program studi berhasil diperbarui.',
            'data' => $programStudi,
        ]);
    }

    /**
     * Hapus Program Studi.
     */
    public function destroy($id)
    {
        $programStudi = ProgramStudi::find($id);

        if (!$programStudi) {
            return response()->json([
                'success' => false,
                'message' => 'Program studi tidak ditemukan.',
            ], Response::HTTP_NOT_FOUND);
        }

        $programStudi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program studi berhasil dihapus.',
        ]);
    }
}
