<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Murids;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class MuridsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $murids = Murids::all();
        return response()->json($murids);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:255|unique:murids,nisn',
            'kelas_id' => 'required|integer',
            'tanggal_lahir' => 'required|date',
        ]);
        $murid = Murids::create($validated);
        return response()->json($murid, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $murid = Murids::findOrFail($id);
        return response()->json($murid);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $murid = Murids::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nisn' => 'sometimes|required|string|max:255|unique:murids,nisn,' . $id,
            'kelas_id' => 'sometimes|required|integer',
            'tanggal_lahir' => 'sometimes|required|date',
        ]);
        $murid->update($validated);
        return response()->json($murid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $murid = Murids::findOrFail($id);
        $murid->delete();
        return response()->json(['message' => 'Murid deleted successfully']);
    }
}
