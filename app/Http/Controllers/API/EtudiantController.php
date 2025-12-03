<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(\App\Models\Etudiant::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenoms' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:etudiants',
            'telephone' => 'nullable|string|max:20',
            'sexe' => 'nullable|in:Masculin,Féminin,Autre',
            'situation_familiale' => 'nullable|in:Célibataire,Marié(e),Avec enfants',
            'date_obtention_baccalaureat' => 'required|date',
            'matricule' => 'required|string|max:50|unique:etudiants',
            'handicap' => 'nullable|string|max:100',
            'photo_profil' => 'nullable|string|max:255',
        ]);

        $etudiant = \App\Models\Etudiant::create($validated);

        return response()->json($etudiant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        return response()->json($etudiant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string|max:100',
            'prenoms' => 'sometimes|string|max:150',
            'email' => 'sometimes|email|max:150|unique:etudiants,email,' . $etudiant->id,
            'telephone' => 'nullable|string|max:20',
            'sexe' => 'nullable|in:Masculin,Féminin,Autre',
            'situation_familiale' => 'nullable|in:Célibataire,Marié(e),Avec enfants',
            'date_obtention_baccalaureat' => 'sometimes|date',
            'matricule' => 'sometimes|string|max:50|unique:etudiants,matricule,' . $etudiant->id,
            'handicap' => 'nullable|string|max:100',
            'photo_profil' => 'nullable|string|max:255',
        ]);

        $etudiant->update($validated);

        return response()->json($etudiant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = \App\Models\Etudiant::findOrFail($id);
        $etudiant->delete();

        return response()->json(null, 204);
    }
}
