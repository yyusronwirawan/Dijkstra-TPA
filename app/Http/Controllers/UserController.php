<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = request('count') ?? 10;
        $search = request('search') ?? '';
        $penggunas = User::when($search != '', function ($query) use ($search) {
            return $query->whereAny([
                'name',
                'email'
            ], 'LIKE', '%' . $search . '%');
        })->select(['id', 'name', 'email'])->orderBy('id', 'DESC')->paginate($count)->withQueryString();
        return view('user.index', compact('penggunas', 'count', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all()->pluck('name');
        return view('user.create', compact('user','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        
        $user = User::create($request->all());

        $user->assignRole($request->role);

        if ($request->hasFile('images')) {
            $user->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('user');
                });
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name');
        return view('user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->role);

        if ($request->hasFile('images')) {

            if($user->getMedia('user')->count() > 0){
                $user->getMedia('user')[0]->delete();
            }

            $user->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('user');
                });
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function destroyImage(User $user)
    {
        $user->getMedia('user')[0]->delete();
        return redirect()->back()->with('destroyImagesuccess', 'Gambar berhasil dihapus');
    }
}
