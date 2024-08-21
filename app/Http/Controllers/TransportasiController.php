<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportasiRequest;
use App\Http\Requests\UpdateTransportasiRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Transportasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = request('count') ?? 10;
        $search = request('search') ?? '';
        $transportasis = Transportasi::when($search != '', function ($query) use ($search) {
            return $query->whereAny([
                'merk',
            ], 'LIKE', '%' . $search . '%');
        })->orderBy('id', 'DESC')->paginate($count)->withQueryString();
        
        return view('transportasi.index', compact('transportasis', 'count', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transportasi = new Transportasi();
        $roles = Role::all()->pluck('name');
        return view('transportasi.create', compact('transportasi', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransportasiRequest $request)
    {

        $transportasi = Transportasi::create($request->all());

        if ($request->hasFile('images')) {
            $transportasi->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('transportasi');
                });
        }

        return redirect()->route('transportasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // return view('transportasi.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transportasi $transportasi)
    {
        return view('transportasi.edit', compact('transportasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransportasiRequest $request, Transportasi $transportasi)
    {
        $transportasi->update($request->all());

        if ($request->hasFile('images')) {

            if ($transportasi->getMedia('user')->count() > 0) {
                $transportasi->getMedia('user')[0]->delete();
            }

            $transportasi->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('transportasi');
                });
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transportasi $transportasi)
    {
        $transportasi->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function destroyImage(User $user)
    {
        $user->getMedia('transportasi')[0]->delete();
        return redirect()->back()->with('destroyImagesuccess', 'Gambar berhasil dihapus');
    }
}
