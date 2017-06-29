@extends('templates.default')

@section('content')
<h1>Update</h1>
<form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" value="PATCH"  name="_method">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="AlbumName" value="{{$album->album_name}}">
    </div>
    <div class="form-group">
        <label for="name">Immagine</label>
        <input type="file" name="album_thumb" id="album_thumb" class="form-control" >
    </div>
     @if($album->album_thumb)
    <div class="form-group">
        <img src="{{$album->album_thumb}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
    </div>
     @endif
    <div class="form-group">
        <label for="description">Description</label>
        <textarea  name="description" id="description" class="form-control" placeholder="Descrizione">{{$album->description}}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>
@endsection
@section('footer')
@parent
   
@endsection