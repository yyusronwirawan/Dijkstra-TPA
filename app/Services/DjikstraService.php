<?php

namespace App\Services;

use App\Models\Graf;
use App\Models\Node;

class DjikstraService
{
    public $nodes;
    public $graf;
    public $grafName;
    public $lok_asal;
    public $lok_akhir;
    public $visited_node = array();
    public $current_node = '';
    public $shortest_distance = array();
    public $previous_node = array();
    public $total_distance = array();
    private $detail_perhitungan = '';


    public function __construct($start,$end)
    {
        $this->nodes = collect(Node::all()->toArray());
        
        $this->grafs = Graf::all()->toArray();
        
        
        // $this->grafs = $grafModel->get(compact('lokasi'))->asArray()->findAll();
        $this->lok_asal = $start;
        $this->lok_akhir = $end;
        
        
        $this->grafName = array_combine(
            array_merge(array_column($this->grafs, 'start'), array_column($this->grafs, 'end')),
            array_merge(array_column($this->grafs, 'start'), array_column($this->grafs, 'end'))
            );


        foreach ($this->grafs as $graf) {
            $this->graf[$graf['start']][$graf['end']] = $graf['jarak'];
        }

        // print '<pre>';
        // print_r($this->graf);
        // exit();

        foreach ($this->grafName as $ki => $vi) {
            foreach ($this->grafName as $kj => $vj) {
                if (isset($this->graf["$ki"]["$kj"])) {
                    $this->graf["$ki"]["$kj"] = $this->graf["$ki"]["$kj"];
                } else {
                    $this->graf["$ki"]["$kj"] = INF;
                }
            }
        }


        $this->run();
    }


    public function run()
    {
        $g_len = count($this->graf);
        while ($g_len--) {

            if ($this->current_node == '') {

                // Start by setting the starting node (A) as the current node.
                $this->current_node = $this->lok_asal;
                $this->shortest_distance[$this->current_node] = 0;
                $this->total_distance[$this->lok_asal] = $this->shortest_distance[$this->current_node];
                // $this->heuristic[$this->current_node][$this->lok_akhir];
            }

            // Check all the nodes connected to A and update their “Distance from A” and set their “previous node” to “A”.
            $checkAllNodes = $this->checkAllNodes($this->current_node);

            $this->detail_perhitungan .= '<div class="">';

            $this->detail_perhitungan .= '<div class="d-flex justify-content-between">';
            $this->detail_perhitungan .= '<span class="m-1 fw-bold">Node: ' . $this->grafName[$this->current_node] . "</span><br/>";
            $this->detail_perhitungan .= '<span class="fw-bold">' . ($this->nodes->where('id', $this->current_node)->first()['cabang']['nama'] ?? $this->nodes->where('id', $this->current_node)->first()['toko']['nama'] ?? 'Node ' . $this->current_node) . "</span>";
            $this->detail_perhitungan .= '</div>';

            if ($checkAllNodes) {
                foreach ($checkAllNodes as $key => $val) {

                    if ($val != INF) {
                        if (!in_array($key, $this->visited_node)) {

                            if (isset($this->shortest_distance[$key])) {
                                if (($this->shortest_distance[$this->current_node] + $val) < $this->shortest_distance[$key]) {

                                    $this->detail_perhitungan .= '<span class="m-1">fs(' . $this->grafName[$key] . ") = </span><br/>";

                                    $this->shortest_distance[$key] = $this->shortest_distance[$this->current_node] + $val;
                                    $this->previous_node[$key] = $this->current_node;
                                    $this->total_distance[$key] = $this->shortest_distance[$key];
                                    // $this->heuristic[$key][$this->lok_akhir];
                                }
                            } else {
                                $this->shortest_distance[$key] = $this->shortest_distance[$this->current_node] + $val;
                                $this->previous_node[$key] = $this->current_node;
                                $this->total_distance[$key] = (float) $this->shortest_distance[$key];
                                // $this->heuristic[$key][$this->lok_akhir];

                                $this->detail_perhitungan .= '<div class="d-flex justify-content-between">';
                                $this->detail_perhitungan .= '<span class="m-1 fst-italic fw-bolder">f(' . $this->grafName[$key] . ') = g(' . $this->grafName[$key] . ')</span><br/>';
                                $this->detail_perhitungan .= '<span>' . ($this->nodes->where('id', $key)->first()['cabang']['nama'] ?? $this->nodes->where('id', $key)->first()['toko']['nama'] ?? 'Node ' . $key) . '</span>';
                                $this->detail_perhitungan .= '</div>';
                                // $this->detail_perhitungan .= 'wefwerwe';
                                // $this->detail_perhitungan .= '<span class="m-1">f(' . $this->grafName[$key] . ") = " . round($val, 2) . "+" . $this->heuristic[$key][$this->lok_akhir] . "</span><br/>";
                                $this->detail_perhitungan .= '<span class="m-1 fst-italic">f(' . $this->grafName[$key] . ") = " . ((float) $this->shortest_distance[$key])."</span><br/>";
                                $this->detail_perhitungan .= '<span class="m-1 fst-italic">f(' . $this->grafName[$key] . ") = " . ((float)$this->total_distance[$key]) . "</span><br/>";
                            }
                        }
                    }
                }

                // Set the current node (A) to "visited" and use the closest unvisited node to A as the current node (e.g. in this case: Node C).
                array_push($this->visited_node, $this->current_node);

                $prev = array_filter($this->previous_node, function ($e) {
                    return $e == $this->current_node;
                });


                // use the closest unvisited node to A as the current node
                $prev = array_keys($prev);
                $temp = array();
                for ($i  = 0; $i < count($prev); $i++) {

                    $temp[$prev[$i]] = $this->total_distance[$prev[$i]];
                }
                if (count($temp) > 0) {
                    $min = array_keys($temp, min($temp));
                    if (count($min) > 0) {
                        $this->current_node = $min[0];
                    } else {
                        break;
                    }
                } else {

                    $temp = array();
                    foreach ($this->total_distance as $k => $v) {
                        if (!in_array($k, $this->visited_node)) {
                            $temp[] = $k;
                        }
                    }
                    $sisa_node_yang_blm_dikunjungi = array();

                    for ($i  = 0; $i < count($temp); $i++) {

                        $sisa_node_yang_blm_dikunjungi[$temp[$i]] = $this->total_distance[$temp[$i]];
                    }
                    if (count($sisa_node_yang_blm_dikunjungi) > 0) {
                        $min = array_keys($sisa_node_yang_blm_dikunjungi, min($sisa_node_yang_blm_dikunjungi));
                        if (count($min) > 0) {
                            $this->current_node = $min[0];
                        }
                    }
                }
            } else {
                // break;
            }
            $this->detail_perhitungan .= '<div class="d-flex justify-content-between">';
            $this->detail_perhitungan .= '<span class="m-1 fw-bolder">Best Node: ' . $this->grafName[$this->current_node] . "</span><br/>";
            // $this->detail_perhitungan .= '<span class="m-1 fw-bolder">'.($this->nodes->where('id',$this->current_node)->first()['cabang']['nama'] ?? $this->nodes->where('id', $this->current_node)->first()['toko']['nama']).'</span>';
            $this->detail_perhitungan .= '</div>';

            $this->detail_perhitungan .= "<div/>";
            $this->detail_perhitungan .= "<div class='border-bottom'></div>";
            if ($this->current_node == $this->lok_akhir) {
                break;
            }
        }
    }

    public function checkAllNodes($node)
    {
        if (array_key_exists($node, $this->graf)) {
            return $this->graf[$node];
        }
        return false;
    }

    public function getPath()
    {
        $node = $this->previous_node;
        $temp = '';
        $path = array();
        while (true) {
            if ($temp == '') $temp = $this->lok_akhir;
            array_push($path, $temp);
            if (!isset($node[$temp])) break;
            $temp = $node[$temp];
        }
        return $path;
    }
    public function getDistance()
    {
        $path = $this->getPath();
        $path = array_reverse($path);
        $total = 0;
        for ($i = 0; $i < (count($path) - 1); $i++) {
            $total += $this->graf[$path[$i]][$path[($i + 1)]];
        }
        return $total;
    }

    public function printPath()
    {
        if ($this->getDistance() > 0) {
            $path = array_map(function ($a) {
                return $this->grafName[$a];
            }, $this->getPath());
            return implode(',', array_reverse($path));
        }
        return "PATH_NOT_FOUND";
    }
    public function getDetailPerhitungan()
    {
        return $this->detail_perhitungan;
    }
}
