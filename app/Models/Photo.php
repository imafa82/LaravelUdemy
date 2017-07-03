<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
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
