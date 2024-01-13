@extends('layouts.layout')
@section('title', 'número de peliculas')
@section('content')

<section class="container-fluid content py-5 mt-5">
<h1 class="mb-5">{{$title}}</h1>

@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <div >
        <p>Total number of films: {{$films}}</p>
    </div>
    
@endif
</section>
@endsection