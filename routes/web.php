<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafController;
use App\Http\Controllers\KonektorController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\PengangkutanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/dashboard', [DashboardController::class,'__invoke'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::resource('/lokasi',LokasiController::class);
    Route::delete('/lokasi-img/{sekolah}/{img}',[LokasiController::class, 'destroyImage'])->name('lokasi.destroy.image');
    
    Route::resource('/konektor',KonektorController::class);
    Route::resource('/node',NodeController::class);
    Route::resource('/graf',GrafController::class);

    Route::resource('/transportasi',TransportasiController::class);
    Route::delete('/transportasi-img/{transportasi}', [TransportasiController::class, 'destroyImage'])->name('transportasi.destroy.image');

    Route::get('pengangkutan/report',[PengangkutanController::class,'report'])->name('pengangkutan.report');
    Route::resource('/pengangkutan',PengangkutanController::class);
    Route::delete('/pengangkutan-img/{pengangkutan}', [PengangkutanController::class, 'destroyImage'])->name('pengangkutan.destroy.image');

    Route::resource('/user',UserController::class);
    Route::delete('/user-img/{user}', [UserController::class, 'destroyImage'])->name('user.destroy.image');
    
    Route::get('/map',[MapController::class,'index'])->name('map.index');
    Route::post('/map/getShortestPath',[MapController::class, 'getShortestPath'])->name('map.getShortestPath');
    Route::get('/map/getAllMarkers',[MapController::class,'getAllMarkers'])->name('map.getAllMarkers');
    Route::get('/map/getAllEdges',[MapController::class, 'getAllEdges'])->name('map.getAllEdges');
    Route::get('/map/node/{node}',[MapController::class, 'getNode'])->name('map.node');
    Route::get('/map/nearest',[MapController::class, 'getNearest'])->name('map.nearest');
    Route::get('/map/{sekolah}',[MapController::class, 'show'])->name('map.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
