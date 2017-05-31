@extends('templates.default')

@section('content')
    <h1>siamo nel blog</h1>
    @component('components.card', 
    [
        'img_title' => 'Image blog',
        'img_url' => 'http://lorempixel.com/400/200'
    ]
    )
    <p>Questa è una bell'immagine</p>
    @endcomponent
@endsection

@section('footer')
    @parent

@endsection
