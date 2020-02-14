@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar Pelicula
         </div>
         <div class="card-body" style="padding:30px">
            <form method="POST">
            
            {{-- TODO: Abrir el formulario e indicar el método POST --}}
            {{method_field('PUT')}}
            {{ csrf_field() }}
            {{-- TODO: Protección contra CSRF --}}

            <div class="form-group">
               <label for="title">Modificar pelicula</label>
               <input type="text" name="title" id="title" class="form-control" value="{{$pelicula->title}}">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el año --}}
               <label for="year"> Año </label>
               <input name="year" type="text" class="form-control" value="{{$pelicula->year}}">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el director --}}
               <label for="director"> Director </label>
                <input name="director" type="text" class="form-control" value="{{$pelicula->director}}">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{$pelicula->synopsis}}</textarea> 
            </div>

            <div class="form-group">
               <label for="trailer"> Trailer </label>
                <input name="trailer" type="text" class="form-control" value="{{$pelicula->trailer}}">
            </div>

            <div class="form-group">
               <label for="category">Categoria</label>
               <select name="category" class="form-control" style="height:3rem">
               @foreach( $categorys as $key => $category )
                  @if( $pelicula->category_id == $category->id)
                  <option selected="true" value="{{$category->id}}">{{$category->title}}</option>
                  @else
                  <option value="{{$category->id}}">{{$category->title}}</option>
                  @endif
               @endforeach
               </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar pelicula
               </button>
            </div>
            </form>
            {{-- TODO: Cerrar formulario --}}

         </div>
      </div>
   </div>
</div>

@stop