@extends('layouts.master')

@section('content')
<h1>TOP 3 peliculas mejor valoradas</h1>
<table class="table table-bordered">
        <tr>
            <th>Nombre pelicula</th>
            <th>Puntuación</th>
        </tr>
    @foreach ($rates as $rate)
    <tr>
        <td>{{$rate->movie->title}}</td>
        <td>{{ $rate->rates }}</td>
    </tr>
    @endforeach
    </table>

@stop