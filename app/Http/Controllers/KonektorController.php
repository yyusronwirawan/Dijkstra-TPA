<?php

namespace App\Http\Controllers;

use App\Models\Konektor;
use App\Http\Requests\StoreKonektorRequest;
use App\Http\Requests\UpdateKonektorRequest;
use MatanYadaev\EloquentSpatial\Objects\Point;

class KonektorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreKonektorRequest $request)
    {
        $konektor = Konektor::create();

        [$lng, $lat] = explode(",", $request->coordinate);

        $konektor->node()->create([
            'coordinates' => new Point($lng, $lat)
        ]);

        return redirect()->route('graf.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Konektor $konektor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konektor $konektor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKonektorRequest $request, Konektor $konektor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konektor $konektor)
    {
        //
    }
}
