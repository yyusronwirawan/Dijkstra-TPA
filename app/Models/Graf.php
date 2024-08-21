<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Graf extends Model
{
    use HasFactory, HasSpatial;
    protected $table = 'grafs';
    protected $fillable = [
        'start',
        'end',
        'jarak',
        'rute'
    ];

    protected $casts = [
        'rute' => LineString::class
    ];

    public function start(){
        return $this->belongsTo(Node::class,'start');
    }
    public function end(){
        return $this->belongsTo(Node::class,'end');
    }
}
