<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengangkutanRequest;
use App\Http\Requests\UpdatePengangkutanRequest;
use App\Models\Pengangkutan;
use App\Models\User;
use Spatie\LaravelPdf\Facades\Pdf;

class PengangkutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = request('count') ?? 10;
        $search = request('search') ?? '';
        $date_start = request('date_start') ?? '';
        $date_end = request('date_end') ?? '';
        $pengangkutans = Pengangkutan::when($search != '', function ($query) use ($search) {
            return $query->whereAny([
                'pengangkut',
            ], 'LIKE', '%' . $search . '%');
        })
        ->when($date_start == '' || $date_end == '', function ($query) {
            return $query->whereDate('created_at', now());
        })
        ->when($date_start != '' || $date_end != '',function($query) use ($date_start,$date_end){
            // return $query->whereBetween('created_at',[$date_start,$date_end]);
            return $query->whereDate('created_at','>=',$date_start)->whereDate('created_at','<=',$date_end);
        })
        ->orderBy('id', 'DESC')->paginate($count)->withQueryString();

        return view('pengangkutan.index', compact('pengangkutans', 'count', 'search','date_start','date_end'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengangkutan = new Pengangkutan();
        return view('pengangkutan.create', compact('pengangkutan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengangkutanRequest $request)
    {
        $pengangkutan = Pengangkutan::create($request->all());

        if ($request->hasFile('images')) {
            $pengangkutan->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('pengangkutan');
                });
        }

        return redirect()->route('pengangkutan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // return view('pengangkutan.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengangkutan $pengangkutan)
    {
        return view('pengangkutan.edit', compact('pengangkutan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengangkutanRequest $request, Pengangkutan $pengangkutan)
    {
        $pengangkutan->update($request->all());

        if ($request->hasFile('images')) {

            if ($pengangkutan->getMedia('pengangkutan')->count() > 0) {
                $pengangkutan->getMedia('pengangkutan')[0]->delete();
            }

            $pengangkutan->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('pengangkutan');
                });
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengangkutan $pengangkutan)
    {
        $pengangkutan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function destroyImage(Pengangkutan $pengangkutan)
    {
        $pengangkutan->getMedia('pengangkutan')[0]->delete();
        return redirect()->back()->with('destroyImagesuccess', 'Gambar berhasil dihapus');
    }

    public function report()
    {
        $count = request('count') ?? 10;
        $search = request('search') ?? '';
        $date_start = request('date_start') ?? '';
        $date_end = request('date_end') ?? '';

        $periode = now()->toDate();
        if($date_start != '' || $date_end != '' ){
            $periode = $date_start .' Sampai '. $date_end;
        }
        $pengangkutans = Pengangkutan::when($search != '', function ($query) use ($search) {
            return $query->whereAny([
                'pengangkut',
            ], 'LIKE', '%' . $search . '%');
        })
        ->when($date_start == '' || $date_end == '', function ($query) {
            return $query->whereDate('created_at',now()->toDate());
        })
        ->when($date_start != '' || $date_end != '', function ($query) use ($date_start, $date_end) {
            return $query->whereDate('created_at', '>=', $date_start)->whereDate('created_at', '<=', $date_end);
        })
        ->orderBy('id', 'DESC')->paginate($count)->withQueryString();
        return view('reports.pengangkutan',compact('pengangkutans','periode'));
    }
}
