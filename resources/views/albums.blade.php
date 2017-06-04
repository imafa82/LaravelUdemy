@extends('templates.default')

@section('content')
<h1>Albums</h1>
<form>
    <input type="hidden" name='_token' id="_token" value="{{csrf_token()}}">
<ul class="list-group">
    @foreach( $albums as $album)
    <li class="list-group-item justify-content-between">{{$album->album_name}} <a href="/albums/{{$album->id}}" class="btn btn-danger">Delete</a></li>
    @endforeach
</ul>
</form>    
@endsection
@section('footer')
@parent
    <script>
        $(document).ready(function(){
            $('ul').on('click', 'a', function(ele){
                ele.preventDefault();
                var urlAlbum = ele.target.href;
                console.log(urlAlbum);
                //var li = ele.target.parentNode;
                var li = $(this).parent();
               
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