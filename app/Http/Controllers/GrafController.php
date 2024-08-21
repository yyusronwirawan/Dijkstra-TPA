<?php

namespace App\Http\Controllers;

use App\Models\Graf;
use App\Http\Requests\StoreGrafRequest;
use App\Http\Requests\UpdateGrafRequest;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class GrafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('graf.index');
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
    public function store(StoreGrafRequest $request)
    {
        $requeustRute = json_decode($request->rute);
        $lineString = array_map(function ($e) {
            return new Point($e[0],$e[1]);
        }, $requeustRute);

        // dd($lineString);
        Graf::updateOrCreate([
            'start' => $request->start,
            'end' => $request->end,
            
        ],[
            'jarak' => $request->jarak,
            'rute' => new LineString($lineString)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Graf $graf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Graf $graf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGrafRequest $request, Graf $graf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Graf $graf)
    {
        return response()->json($graf->delete());
    }
}
