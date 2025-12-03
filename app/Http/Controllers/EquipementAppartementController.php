<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipementAppartementRequest;
use App\Http\Requests\UpdateEquipementAppartementRequest;
use App\Models\EquipementAppartement;

class EquipementAppartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EquipementAppartement::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipementAppartementRequest $request)
    {
        $equipementAppartement = EquipementAppartement::create($request->validated());

        return response()->json($equipementAppartement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipementAppartement $equipementAppartement)
    {
        return $equipementAppartement;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipementAppartement $equipementAppartement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipementAppartementRequest $request, EquipementAppartement $equipementAppartement)
    {
        $equipementAppartement->update($request->validated());

        return $equipementAppartement;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipementAppartement $equipementAppartement)
    {
        $equipementAppartement->delete();

        return response()->noContent();
    }
}
