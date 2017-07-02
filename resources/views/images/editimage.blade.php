@extends('templates.default')

@section('content')
<h1>New Album</h1>
<form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('PATCH')}}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="ImgName" value="{{$photo->name}}">
    </div>
    <input type="hidden" name="album_id" value="{{$photo->album_id}}">
    @include('images.partials.fileupload')
    <div class="form-group">
        <label for="description">Description</label>
        <textarea  name="description" id="description" class="form-control" placeholder="Descrizione">{{$photo->description}}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>
@endsection
@section('footer')
@parent
   
@endsection