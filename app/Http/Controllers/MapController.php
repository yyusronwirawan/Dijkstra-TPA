<?php

namespace App\Http\Controllers;

use App\Models\Graf;
use App\Models\Lokasi;
use App\Models\Node;
use App\Services\DjikstraService;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        return view('map.index');
    }

    public function getNearest($lat = 0,$lng = 0){
        // $lat = -6.200735595;
        // $lng = 107.7708098;
        $nodes = Node::all()->map(function($e) use($lat,$lng){
            $lat1 = $e->coordinates->latitude;
            $lng1 = $e->coordinates->longitude;
            return [
                'id' => $e->id,
                // 'dist' => $e->coordinates->latitude
                'dist' => sqrt(pow($lat1 - $lat, 2) + pow($lng1 - $lng, 2)) * 111.319
            ];
        });


        return $nodes->sortBy('dist')->first()['id'];
    }

    public function getShortestPath(Request $request){


        $start = $request->input('start');

        if($start == '-1'){
            [$lat,$lng] = explode(",",$request->current);
            $start = (string) $this->getNearest($lng,$lat);
        }

        $end = $request->input('end');

        $astar = new DjikstraService($start, $end);
        $path = explode(',', $astar->printPath());

        $result = array();
        $result['coordinates'] = [];
        $result['path'] = [];
        $result['distance'] = $astar->getDistance();
        $result['perhitungan'] = $astar->getDetailPerhitungan();

        for ($i = 0; $i < count($path) - 1; $i++) {
            $graf = Graf::with(['start.taggable', 'end.taggable'])->where('start', $path[$i])->where('end', $path[$i + 1])->first()->toArray();

            $coord = ['geometry' =>$graf['rute'],'type' => 'Feature','prpoperties' => [
                'color' => fake()->safeHexColor()
            ]];
            
            array_push($result['coordinates'], $coord);
        }

        return response()->json($result);
    }

    public function getAllMarkers(){
        $nodes = Node::with('taggable')->get()->setHidden(['created_at','updated_at'])->map(function($e) {
            $nama = '';

            if($e->taggable_type == 'App\Models\Konektor'){
                $nama = 'Node '. $e->id;
            }else{
                $nama = $e->taggable->nama;
            }

            return [
                'id' => $e->id,
                'taggable_type' => $e->taggable_type,
                'coordinates' => $e->coordinates,
                'nama' => $nama,
                'image' => $e->taggable_type == 'App\\Models\\Lokasi' 
                    ? ($e->taggable->getMedia('lokasi')[0] ?? false) 
                    :
                     ''
            ];
        });

        return response()->json($nodes);
    }

    public function getAllEdges(){
        $grafs = Graf::all()->setVisible(['rute']);

        $features = [];

        foreach($grafs as $g){
            $features[$g->start][] = [
                'type' => 'Feature',
                'geometry' => $g->rute,
                'properties' => [
                    'id' => $g->id,
                    'color' => fake()->safeHexColor()
                ],
            ];
        }

        return response()->json($features);
    }

    public function getNode(Node $node){

        $taggable = $node->taggable()->first();
        if($node->taggable_type == 'App\Models\Lokasi'){
            $prooperties = [
                'nama' => $taggable->nama,
                'img' => $taggable->getMedia('lokasi')->first()
            ];
        }else{
            $prooperties = [
                'nama' => 'Node '.$node->id
            ];
        }

        $n = [
            ...$node->setHidden([
                'created_at',
                'updated_at',
                'taggable_type',
                'taggable_id'])->toArray(),
            'properties' => $prooperties
        ];
        return response()->json($n);
    }

    public function show(Lokasi $lokasi){
        return view('map.show', compact('lokasi'));
    }
}
