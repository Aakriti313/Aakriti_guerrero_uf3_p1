@extends('layouts.layout')
@section('title', 'actores')
@section('content')

<section class="container-fluid content py-5 mt-5">
<h1 class="mb-5">{{$title}}</h1>

@if(empty($actors))
    <FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
    <div align="center">
    <table border="1">
        
        @foreach($actors as $actor)
            <tr>
                <td>{{$actor->id}}</td>
                <td>{{$actor->name}}</td>
                <td>{{$actor->surname}}</td>
                <td>{{$actor->birthdate}}</td>
                <td>{{$actor->country}}</td>
                <td><img src="{{ $actor->img_url}}" style="width: 100px; height: 120px;"/></td>
            </tr>
        @endforeach
    </table>
    </div>

@endif
</section>
@endsection