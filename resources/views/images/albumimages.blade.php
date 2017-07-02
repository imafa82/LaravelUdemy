@extends('templates.default')
@section('content')
<table class="table">
    <tr>
        <th>
            ID
        </th>
        <th>
            CREATED DATE
        </th>
        <th>
            TITLE
        </th>
        <th>
            ALBUM
        </th>
        <th>
            THUMBNAIL
        </th>
    </tr>
    @forelse($images as $image)
    <tr>
        <td>{{$image->id}}</td>
        <td>{{$image->created_at}}</td>
        <td>{{$image->name}}</td>
        <td>{{$id->album_name}}</td>
        <td><img width="120" src="{{asset($image->img_path)}}" /></td>
        <td>
            <a href="{{route('photos.destroy', $image->id)}}" class="btn btn-danger">DELETE</a> 
            <a href="{{route('photos.edit', $image->id)}}" class="btn btn-default">EDIT</a> 
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">
            No images found
        </td>
    </tr>
    @endforelse
</table>

@endsection

@section('footer')
@parent
<script>
    $('document').ready(function(){
        $('table').on('click', 'a.btn-danger', function(ele){
            ele.preventDefault();
            var urlImg = $(this).attr('href');
            var tr = ele.target.closest('tr');
            $.ajax(
                    urlImg,
                    {
                        method: 'DELETE',
                        data:{'_token':'{{csrf_token()}}'},
                        complete: function (resp) {
                            console.log(resp);
                            if(resp.responseText == 1){
                                tr.remove();
                            } else {
                                alert('Problem contacting server');
                            }
                        }
                   }
            );
        })
    });
</script>
@endsection