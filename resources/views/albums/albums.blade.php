@extends('templates.default')

@section('content')
<h1>Albums</h1>

@if(session()->has('message'))
    @component('components.alert-info')
        {{ session()->get('message') }}
    @endcomponent
@endif
<form>
    <input type="hidden" name='_token' id="_token" value="{{csrf_token()}}">
<ul class="list-group">
    @foreach( $albums as $album)
    <li class="list-group-item justify-content-between">
        {{$album->album_name}} 
        <div>

            @if($album->album_thumb)
                <img width="120" src="{{$album->path}}" alt="{{$album->album_name}}" title="{{$album->album_name}}">
            @endif
                <a href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-primary">New Images</a>
            @if($album->photos_count)



            <a href="/albums/{{$album->id}}/images" class="btn btn-primary">View Images({{$album->photos_count}})</a> 
            @endif
            <a href="/albums/{{$album->id}}/edit" class="btn btn-primary">Edit</a> 
            <a href="/albums/{{$album->id}}" class="btn btn-danger">Delete</a>
        </div>
    </li>
    @endforeach
        <li>
                <div class="row">
                    <div class="col-md-8 push-2">
                        {{$albums->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
        </li>
</ul>
</form>    
@endsection
@section('footer')
@parent
    <script>
        $(document).ready(function(){
            $('div.alert').fadeOut(5000);
            $('ul').on('click', 'a.btn-danger', function(ele){
                ele.preventDefault();
                var urlAlbum = ele.target.href;
                console.log(urlAlbum);
                //var li = ele.target.parentNode.parentNode;
                var li = $(this).parent().parent();
               
                $.ajax(urlAlbum, {
                    method: "DELETE",
                    data: {
                        '_token': $('#_token').val()
                    },
                    complete: function (response){
                        console.log(response);
                        if(response.responseText == 1){
                  //          li.parentNode.removeChild(li);
                              $(li).remove();
                        } else {
                            alert("Non eliminato");
                        }
                    }
                }
                        )
            })
        });
    </script>
@endsection