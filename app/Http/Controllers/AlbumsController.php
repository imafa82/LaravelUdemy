<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\DB;
class AlbumsController extends Controller
{
    public function index(Request $request){
       // return Album::all();
        $sql= "select * from albums WHERE 1=1 ";
        $where = [];
        if($request->has('id')){
            $where ['id'] = $request->get('id');
            $sql .= " AND id=:id ";
        }
        if($request->has('name')){
            $where ['album_name'] = $request->get('name');
            $sql .= " AND album_name=:album_name ";
        }
        $albums = DB::select($sql, $where);
        //var_dump($albums);
        return view('albums.albums', ['albums' => $albums]);
    }
    
    public function delete($id){
        $sql = "DELETE FROM albums WHERE id= :id";
        return DB::delete($sql, ['id' => $id]);
        //return redirect()->back();
    }
    
    public function edit($id){
        $sql = 'SELECT id, album_name, description FROM albums WHERE id = :id';
        $album = DB::select($sql, ['id'=> $id]);
        
        return view('albums.edit')->with('album', $album[0]);
    }
    
    public function show($id){
        $sql = "SELECT * FROM albums WHERE id= :id";
        return DB::select($sql, ['id' => $id]);
        //return redirect()->back();
    }
    
      public function store(Request $request, $id){
          $data = request()->only(['name', 'description']);
          $data['id'] = $id;
          $sql = 'UPDATE albums SET album_name=:name, description=:description';
          $sql .= ' WHERE id=:id';
          $res = DB::update($sql, $data);
          dd($res);
    }
}
