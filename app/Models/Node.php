<?php

namespace App\Models;

use Bagusindrayana\LaravelCoordinate\Traits\LaravelCoordinate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Node extends Model
{
    use HasFactory, HasSpatial;
    protected $table = 'nodes';

    protected $casts = [
        'coordinates' => Point::class,
    ];
    
    protected $fillable = [
        'coordinates',
        'taggable_type',
        'taggable_id',
    ];

    public function taggable(){
        return $this->morphTo();
    }
}
