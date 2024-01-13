@extends('layouts.layout')
@section('title', 'Lista de peliculas')
@section('content')

<section class="py-5 text-center" style="background-color: #8AAEE0;">
    <h2 class="mt-5">🍿 LIST OF FILMS 🍿</h2>
    <ul class="mt-3 list-group list-group-flush list-unstyled">
        <li><a href=/filmout/oldFilms class="list-group-item list-group-item-action list-group-item-info" >🎬 Old Films</a></li>
        <li><a href=/filmout/newFilms class="list-group-item list-group-item-action list-group-item-info">🎬 New Films</a></li>
        <li><a href=/filmout/films class="list-group-item list-group-item-action list-group-item-info">🎬 Films</a></li>
        <li><a href=/filmout/filmsByYear class="list-group-item list-group-item-action list-group-item-info">🎬 Films by year</a></li>
        <li><a href=/filmout/filmsByGenre class="list-group-item list-group-item-action list-group-item-info">🎬 Films by genre</a></li>
        <li><a href=/filmout/sortFilms class="list-group-item list-group-item-action list-group-item-info">🎬 Films by year from new to old</a></li>
        <li><a href=/filmout/countFilms class="list-group-item list-group-item-action list-group-item-info">🎬 Total number of films</a></li>
    </ul>

    <!--New Form where create new films-->
    <form class="mt-5" action="{{route('createFilm')}}" method="post" id="formularioPelicula">
        {{csrf_field()}}
        <h2 class="mb-3">ADD FILMS</h2>
        <label for="nombre">Name:</label>
        <input type="text" id="nombre" name="nombre" style="background: none;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label for="ano">Year:</label>
        <input type="text" id="ano" name="ano" style="background: none;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label for="genero">Genre:</label>
        <input type="text" id="genero" name="genero" style="background: none;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label for="pais">Country:</label>
        <input type="text" id="pais" name="pais" style="background: none;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label for="duracion">Duration:</label>
        <input type="text" id="duracion" name="duracion" style="background: none;border: none;border-bottom: 1px solid black;" required>
        <br>
        <label for="img_url">URL Image:</label>
        <input type="text" id="img_url" name="img_url" style="background: none;border: none;border-bottom: 1px solid black;">
        <br>
        <input type="submit" class="btn btn-outline-info" value="Enviar">
    </form>
</section>

@endsection