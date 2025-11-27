<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(\App\Models\Appartement::with('batiment')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'batiment_id' => 'required|exists:batiments,id',
            'numero' => 'required|string|max:20',
            'etage' => 'required|integer',
            'type_appartement' => 'nullable|in:Studio,T1,T2,Chambre partagée',
            'capacite_personnes' => 'required|integer|min:1',
            'disponibilite' => 'boolean',
            'etat' => 'nullable|in:Neuf,Bon,Moyen,Nécessite réparations,Hors service',
            'superficie' => 'nullable|numeric',
            'loyer_mensuel' => 'required|numeric',
        ]);

        // Unique check for batiment_id + numero
        $exists = \App\Models\Appartement::where('batiment_id', $request->batiment_id)
            ->where('numero', $request->numero)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'This apartment number already exists in this building.'], 422);
        }

        $appartement = \App\Models\Appartement::create($validated);

        return response()->json($appartement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appartement = \App\Models\Appartement::with('batiment')->findOrFail($id);
        return response()->json($appartement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appartement = \App\Models\Appartement::findOrFail($id);

        $validated = $request->validate([
            'batiment_id' => 'sometimes|exists:batiments,id',
            'numero' => 'sometimes|string|max:20',
            'etage' => 'sometimes|integer',
            'type_appartement' => 'nullable|in:Studio,T1,T2,Chambre partagée',
            'capacite_personnes' => 'sometimes|integer|min:1',
            'disponibilite' => 'boolean',
            'etat' => 'nullable|in:Neuf,Bon,Moyen,Nécessite réparations,Hors service',
            'superficie' => 'nullable|numeric',
            'loyer_mensuel' => 'sometimes|numeric',
        ]);

        if (isset($validated['batiment_id']) || isset($validated['numero'])) {
             $batimentId = $validated['batiment_id'] ?? $appartement->batiment_id;
             $numero = $validated['numero'] ?? $appartement->numero;

             $exists = \App\Models\Appartement::where('batiment_id', $batimentId)
                ->where('numero', $numero)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return response()->json(['message' => 'This apartment number already exists in this building.'], 422);
            }
        }

        $appartement->update($validated);

        return response()->json($appartement);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appartement = \App\Models\Appartement::findOrFail($id);
        $appartement->delete();

        return response()->json(null, 204);
    }
}
