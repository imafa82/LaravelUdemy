<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Album extends Model {
    //protected $table = 'Albums';
    //protected $primaryKey = 'id';
    protected $fillable = ['album_name', 'description', 'user_id'];
}
