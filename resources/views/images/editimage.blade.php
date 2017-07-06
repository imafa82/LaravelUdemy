@extends('templates.default')

@section('content')
<h1>
    @if($photo->id)
        Update Image
    @else
        New Image
    @endif
</h1>
@include('partials.inputError')
@if($photo->id)
    <form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">

        {{method_field('PATCH')}}
        @else
            <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">

                @endif

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="ImgName" value="{{$photo->name}}">
    </div>
                {{csrf_field()}}
    @include('images.partials.fileupload')
    <div class="form-group">
        <label for="description">Description</label>
        <textarea  name="description" id="description" class="form-control" placeholder="Descrizione">{{$photo->description}}</textarea>
    </div>
    <div class="form-group">

        <select name="album_id" id="album_id">
            <option value="">SELECT</option>
            @foreach($albums as $item)
                <option {{$item->id == $album->id? 'selected':''}} value="{{$item->id}}">{{$item->album_name}}</option>
            @endforeach
        </select>


    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" >Submit</button>
    </div>
</form>
@endsection
@section('footer')
@parent
   
@endsection