@extends('templates.default')

@section('content')
<h1>Update</h1>
<form action="{{route('album.save')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="AlbumName" value="">
    </div>
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