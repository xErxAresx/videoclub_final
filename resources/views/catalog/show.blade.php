@extends('layouts.master')

@section('content')

<div class="row">

<div class="col-sm-4" margin-top= 25px>

<img src="{{$pelicula->poster}}" style="height:500px"/>

</div>
<div class="col-sm-8" margin-top= 25px>

<h1>{{$pelicula->title}}</h1>
<h2>Dirigida por {{$pelicula->director}}</h2>
<h3>{{$pelicula->year}}</h3>
<p>{{$pelicula->synopsis}}</p>
@if(is_null($pelicula->category_id))
<p>Categoria: Aquesta pelicula no te una categoria encara</p>
@else
<p>Categoria: {{$pelicula->category->title}}</p>
@endif
<p>
            @if($pelicula->rented)
            <p>Estado: Alquilada</p>
            <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="display:inline">
                    Devolver película
                </button>
            </form>
            @else
            <p>Estado: Libre</p>
            <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
                <button type="submit" class="btn btn-success" style="display:inline,background-color:green">
                    Reservar película
                </button>
            </form>
            @endif
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <span class="glyphicon glyphicon-expand"> </span> Trailer
            </button>
            <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-heart"> </span> Afegir a Preferits</button>
            <button type="button" class="btn btn-primary"><a href="{{ url('/catalog/edit/' . $pelicula->id ) }}" style="color:white;"><span class="glyphicon glyphicon-pencil"> </span> Editar pelicula</a></button>
            <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST" style="display:inline">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="display:inline">
                    Eliminar película
                </button>
            </form>
            <button type="button" class="btn btn-primary"><a href="{{ url('/catalog/') }}" style="color: white;"> <span class="glyphicon glyphicon-chevron-left"> </span> Volver al listado</a></button>
        </p>
</div>
</div>
<!--COMENTARIS-->
<hr>
<h3 style="margin-top: 10px;">Comentaris</h3>
<div id="comentaris">
    @foreach( $reviews as $key => $review )
    <div class="" style="border-left: 5px solid grey">
        <div class="media mt-3" style="margin-left: 10px">
            <div class="media-body">
                <h5 class="mt-0">{{$review->title}}</h5>
                <h6>{{$review->stars}}</h6>
                {{$review->review}}
                <p style="margin-top:5px; font-size: 14px; color: grey">- {{$review->created_at}}  - {{$review->user->name}}</p>
            </div>
        <hr>
        </div>
    </div>
    @endforeach
</div>
<hr>

<!--VALORACIÓ-->
<form style="margin-bottom: 10px" method="POST" action="{{action('CatalogController@postCreateR', $pelicula->id)}}">
{{ csrf_field() }}
  <div class="form-group">
  <br>
    <label for="exampleFormControlInput1">Enviar comentari:</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Resum comentari">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Selecciona el numero de estrelles:</label>
    <select class="form-control"  name="stars" id="stars">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <textarea class="form-control" name="review" id="review" placeholder="Dona'ns la teva opinio" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Valorar</button>
  <button type="button" class="btn btn-dark">Cancel·lar</button>
</form>

<!--MODAL-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Trailer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-4by3">
            <iframe class="embed-responsive-item" src="{{$pelicula->trailer}}"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@stop