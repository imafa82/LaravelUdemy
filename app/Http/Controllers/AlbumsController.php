<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\DB;
class AlbumsController extends Controller
{
    public function index(Request $request){
       // return Album::all();
        $queryBuilder = DB::table('albums')->orderBy('id', 'DESC');
        if($request->has('id')){
            $queryBuilder->where('id', $request->input('id'));
        }
        if($request->has('album_name')){
            $queryBuilder->where('album_name', 'like', $request->input('album_name').'%');
        }
        $albums = $queryBuilder->get();
        return view('albums.albums', ['albums' => $albums]);
         //$sql= "select * from albums WHERE 1=1 ";
//        $where = [];
//        if($request->has('id')){
//            $where ['id'] = $request->get('id');
//            $sql .= " AND id=:id ";
//        }
//        if($request->has('name')){
//            $where ['album_name'] = $request->get('name');
//            $sql .= " AND album_name=:album_name ";
//        }
//        $sql .= " ORDER BY id DESC";
//        $albums = DB::select($sql, $where);
//        //var_dump($albums);
//        return view('albums.albums', ['albums' => $albums]);
    }
    
    public function delete($id){
        $res = DB::table('albums')->where('id', $id)->delete();
        return $res;
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
          $res =DB::table('albums')->where('id', $id)->update(
                  ['description' => request()->input('description'),
                  'album_name' => request()->input('name')]
                  
                  );
          
//          $data = request()->only(['name', 'description']);
          $nome = request()->get('name');
//          $data['id'] = $id;
//          $sql = 'UPDATE albums SET album_name=:name, description=:description';
//          $sql .= ' WHERE id=:id';
//          $res = DB::update($sql, $data);
          $messaggio = $res? "Album $nome Aggiornato" : "Aggiornamento non riusciuto";
          session()->flash('message', $messaggio);
          return redirect()->route('albums');
    }
    
      public function create(){
        
        return view('albums.create');
    }
    public function save(){
         $res =DB::table('albums')->insert(
                  ['description' => request()->input('description'),
                  'album_name' => request()->input('name'),
                      'user_id' => 1
                 
                 ]
                  
                  );
//        $data = request()->only(['name', 'description']);
//        $data ['user_id'] = 1;
//        $sql = 'INSERT INTO albums (album_name, description, user_id)';
//        $sql .= ' VALUES(:name,:description,:user_id)';
//        $res = DB::insert($sql, $data);
        $messaggio = $res? "Album". request()->input('name')." creato" : "Inserimento non riusciuto";
          session()->flash('message', $messaggio);
        //return view('albums.create');
          return redirect()->route('albums');
    }
}