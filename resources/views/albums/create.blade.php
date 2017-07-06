@extends('templates.default')

@section('content')
<h1>New Album</h1>
@include('partials.inputError')
<form action="{{route('album.save')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="AlbumName" value="">
    </div>
    @include('albums.partials.fileupload')
    <div class="form-group">
        <label for="description">Description</label>
        <textarea  name="description" id="description" class="form-control" placeholder="Descrizione"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>
@endsection
@section('footer')
@parent
   
@endsection