<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DossierCandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(\App\Models\DossierCandidature::with('etudiant')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'annee_universitaire' => 'required|string|max:20',
            // date_soumission is handled by database default or can be passed
            'statut' => 'nullable|in:En cours,Validé,Rejeté,En attente paiement,Attribué',
            'score_selection' => 'nullable|numeric',
            'commentaire_admin' => 'nullable|string',
        ]);

        $dossier = \App\Models\DossierCandidature::create($validated);

        return response()->json($dossier, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dossier = \App\Models\DossierCandidature::with('etudiant')->findOrFail($id);
        return response()->json($dossier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dossier = \App\Models\DossierCandidature::findOrFail($id);

        $validated = $request->validate([
            'etudiant_id' => 'sometimes|exists:etudiants,id',
            'annee_universitaire' => 'sometimes|string|max:20',
            'statut' => 'nullable|in:En cours,Validé,Rejeté,En attente paiement,Attribué',
            'score_selection' => 'nullable|numeric',
            'commentaire_admin' => 'nullable|string',
        ]);

        $dossier->update($validated);

        return response()->json($dossier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dossier = \App\Models\DossierCandidature::findOrFail($id);
        $dossier->delete();

        return response()->json(null, 204);
    }
}
