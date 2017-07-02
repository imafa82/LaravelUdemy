<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AlbumsController extends Controller
{
    public function index(Request $request){
       // return Album::all();
        $queryBuilder = Album::orderBy('id', 'DESC')->withCount('photos');
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
    
    public function delete(Album $id){
        //$res = Album::where('id', $id)->delete();
        //$res = Album::find($id)->delete();
        $thumbNail = $id->album_thumb;
        $res = $id->delete();
        if($res){
            if ($thumbNail && Storage::disk('public')->has(env('ALBUM_THUMB_DIR')."/".$thumbNail)){
                Storage::disk('public')->delete(env('ALBUM_THUMB_DIR')."/".$thumbNail);
            }
        }
        return "".$res;
        //return redirect()->back();
    }
    
    public function edit($id){
//        $sql = 'SELECT id, album_name, description FROM albums WHERE id = :id';
//        $album = DB::select($sql, ['id'=> $id]);
        $album = Album::find($id);
        return view('albums.edit')->with('album', $album);
    }
    
    public function show($id){
        $sql = "SELECT * FROM albums WHERE id= :id";
        return DB::select($sql, ['id' => $id]);
        //return redirect()->back();
    }
    
      public function store(Request $request, $id){
//          $res = Album::where('id', $id)->update(
//                  ['description' => request()->input('description'),
//                  'album_name' => request()->input('name')]
//                  
//                  );
          $album = Album::find($id);
          $album->album_name = request()->input('name');
          $album->description = request()->input('description');
          $this->processFile($id, $request, $album);
          $res = $album->save();
          
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
        $album = new Album();
        return view('albums.create', ['album'=> $album]);
    }
    public function save(){
//         $res =Album::insert(
//                  ['description' => request()->input('description'),
//                  'album_name' => request()->input('name'),
//                      'user_id' => 1
//                 
//                 ]
//                  
//                  );
        $album = new Album();
        $album->album_name = request()->input('name');
        $album->description = request()->input('description');
        $album->album_thumb = '';
        $album->user_id = 1;
        
        $res = $album->save();
        if ($res){
            if($this->processFile($album->id, request(), $album)){
                $res = $album->save();
            };
        }
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
    public function getImages(Album $id){
        $images = Photo::where('album_id', $id->id)->get();
        return view('images.albumimages', compact('id', 'images'));
    }


    private function processFile($id, $request, &$album){
         
         if(!$request->hasFile('album_thumb')){
         
             return false;
         }    
          $file = $request->file('album_thumb');   
          if(!$file->isValid()){
         
             return false;
         } 
              
                   //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
                    $fileName = $id.'.'.$file->extension();
                    $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName);
                    $album->album_thumb = $fileName;
         return true;     
              
          
    }
}
