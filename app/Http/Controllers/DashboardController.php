<?php

namespace App\Http\Controllers;

use App\Models\Pengangkutan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->getRoleNames()[0] == 'Administrator') {
            $cards['count'] = [
                [
                    'title' => 'Transportasi',
                    'count' => \App\Models\Transportasi::count()
                ],
                [
                    'title' => 'Lokasi',
                    'count' => \App\Models\Lokasi::count()
                ],
                [
                    'title' => 'Graf',
                    'count' => \App\Models\Graf::count()
                ],
                [
                    'title' => 'Pengguna',
                    'count' => \App\Models\User::count()
                ],
            ];
            return view('dashboard.index', compact('cards'));
        }

        if (Auth::user()->getRoleNames()[0] == 'Operasional') {
            $cards['count'] = [
                [
                    'title' => 'Pengangkutan',
                    'count' => \App\Models\Pengangkutan::count()
                ],
            ];
            return view('dashboard.index', compact('cards'));
        }

        if (Auth::user()->getRoleNames()[0] == 'Pimpinan') {
            $cards['count'] = [
                [
                    'title' => 'Transportasi',
                    'count' => \App\Models\Transportasi::count()
                ],
            ];

            $date = now();
            if(request('date')){
                $date = Carbon::createFromFormat('Y-m-d',request('date'));
            }

            $pengangkutans = DB::table('pengangkutan')
            ->join('transportasi','pengangkutan.transportasi_id','=','transportasi.id')
            ->select(DB::raw('WEEK(pengangkutan.created_at) as week,concat(transportasi.merk," (",transportasi.plat,")") as kendaraan,sum(liter) as total_liter'))
                        ->groupBy('transportasi_id')    
                        ->groupBy('week')
                        ->whereRaw('WEEK(pengangkutan.created_at) = '. $date->week)
                        ->orderBy('week')
                        ->get();

                        
            $kendaraans_ = $pengangkutans ? $pengangkutans->pluck('kendaraan')->toArray() : [];
            $total_liter_ = $pengangkutans ? $pengangkutans->pluck('total_liter')->toArray() : [];

            $cards['chart'] = [$kendaraans_,$total_liter_];

            return view('dashboard.index', compact('cards'));
        }
    }
}
