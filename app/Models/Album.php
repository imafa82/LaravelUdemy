<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Album extends Model {
    //protected $table = 'Albums';
    //protected $primaryKey = 'id';
    protected $fillable = ['album_name', 'description', 'user_id'];
    
    public function getPathAttribute(){
        $url = $this->album_thumb;
        if(stristr($this->album_thumb, 'http') === false){
            $url = "storage/".env('ALBUM_THUMB_DIR')."/".$this->album_thumb;
        }
        return $url;
    }
}
