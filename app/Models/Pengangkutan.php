<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pengangkutan extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $table = 'pengangkutan';
    protected $fillable = ['user_id','transportasi_id','pengangkut','lokasi_awal','lokasi_tujuan','jarak','liter','harga','status'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function nodeAwal(){
        return $this->belongsTo(Node::class,'lokasi_awal','id');
    }

    public function nodeTujuan(){
        return $this->belongsTo(Node::class,'lokasi_tujuan','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transportasi(){
        return $this->belongsTo(Transportasi::class);
    }
}
