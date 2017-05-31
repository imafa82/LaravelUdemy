@extends('templates.default')
@section('title', $title);
@section('content')
<h1>{{ $title }}</h1>

@if(!empty($staff))
<ul>
    @foreach ($staff as $person)
    <li style="{{$loop->first ? 'color:red': ''}}"> {{$person['name']}} {{$person['lastname']}}</li>
    @endforeach
</ul>
@else
<p>No staff</p>
@endif

@endsection
