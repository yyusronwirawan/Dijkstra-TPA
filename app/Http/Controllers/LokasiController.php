<?php

namespace App\Http\Controllers;

use App\Http\Requests\LokasiStoreRequest;
use App\Http\Requests\LokasiUpdateRequest;
use App\Http\Requests\SekolahUpdateRequest;
use App\Models\Lokasi;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = request('count') ?? 10;
        $search = request('search') ?? '';
        $lokasis = Lokasi::when($search != '',function($query) use($search){
            return $query->whereAny([
                'nama',
            ],'LIKE','%'.$search.'%');
        })->select(['id','nama'])->orderBy('id','DESC')->paginate($count)->withQueryString();
        return view('lokasi.index',compact('lokasis','count','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasi = new Lokasi();
        return view('lokasi.create',compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LokasiStoreRequest $request)
    {
        $sekolah = Lokasi::create($request->all());

        [$lng,$lat] = explode(",",$request->coordinate);

        $sekolah->node()->create([
            'coordinates' => new Point($lng, $lat)
        ]);

        if($request->hasFile('images')){
            $sekolah->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('sekolah');
                });
        }

        return redirect()->route('lokasi.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        return view('lokasi.show',compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        return view('lokasi.edit',compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LokasiUpdateRequest $request, Lokasi $lokasi)
    {
        $lokasi->update($request->all());


        [$lng, $lat] = explode(",", $request->coordinate);
        
        $lokasi->node()->delete();
        $lokasi->node()->create([
            'coordinates' => new Point($lng, $lat)
        ]);

        if ($request->hasFile('images')) {
            $lokasi->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('sekolah');
            });
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        $lokasi->node()->delete();
        $lokasi->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }

    public function destroyImage(Lokasi $lokasi,$img){
        $lokasi->getMedia('lokasi')[$img]->delete();
        return redirect()->back()->with('destroyImagesuccess','Gambar berhasil dihapus');
    }
}
