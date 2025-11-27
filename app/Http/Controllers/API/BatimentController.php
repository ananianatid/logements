<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(\App\Models\Batiment::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100|unique:batiments',
            'type_batiment' => 'nullable|in:Résidence,Cité universitaire,Bloc',
            'capacite_totale' => 'required|integer',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $batiment = \App\Models\Batiment::create($validated);

        return response()->json($batiment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $batiment = \App\Models\Batiment::findOrFail($id);
        return response()->json($batiment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $batiment = \App\Models\Batiment::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:100|unique:batiments,nom,' . $batiment->id,
            'type_batiment' => 'nullable|in:Résidence,Cité universitaire,Bloc',
            'capacite_totale' => 'sometimes|integer',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $batiment->update($validated);

        return response()->json($batiment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $batiment = \App\Models\Batiment::findOrFail($id);
        $batiment->delete();

        return response()->json(null, 204);
    }
}
