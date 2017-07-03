<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('images.editimage', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {

        $this->processFile($photo);
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $res = $photo->save();
        $messaggio = $res? "Image". request()->input('name')." update" : "Update non riusciuto";
        session()->flash('message', $messaggio);
        //return view('albums.create');
        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $res = Photo::destroy($photo->id);
        if ($res){
            $this->processFile($photo);
        }
        return $res;
        //return Photo::destroy($id);
        
    }
    
    private function processFile(Photo &$photo, $request = null){
        if(!$request){
            $request = \request();
        }
         
         if(!$request->hasFile('img_path')){
         
             return false;
         }    
          $file = $request->file('img_path');   
          if(!$file->isValid()){
         
             return false;
         } 
              
                   //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
                    $fileName = $photo->id.'.'.$file->extension();
                    $file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $fileName);
                    $photo->img_path = env('IMG_DIR').'/'.$photo->album_id.'/'.$fileName;
         return true;     
              
          
    }
    public function deleteFile(Photo $photo){
        $disk = config('filesystems.default');
        if($photo->img_path && Storage::disk($disk)->has($photo->img_path)){
            return Storage::disk($disk)->delete($photo->img_path);
        }
        return false;
    }
}
