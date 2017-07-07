@extends('templates.default')

@section('content')
<h1>Update</h1>
@include('partials.inputError')
<form action="/albums/{{$album->id}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" value="PATCH"  name="_method">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Album Name" value="{{$album->album_name}}">
    </div>
    @include('albums.partials.fileupload')
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