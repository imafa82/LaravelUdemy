<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['name', 'img_path', 'description'];

    public function album(){
        //$this->belongsTo(Album::class, 'album_id', 'id');
        return $this->belongsTo(Album::class);
    }
    //
    public function getPathAttribute(){
        $url = $this->img_path;
        if(stristr($url, 'http') === false){
            $url = "storage/".$this->img_path;
        }
        return $url;
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
    }

}
