@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Añadir película
         </div>
         <div class="card-body" style="padding:30px">
   <form method="POST">
            
            {{-- TODO: Abrir el formulario e indicar el método POST --}}

            {{-- TODO: Protección contra CSRF --}}
            {{ csrf_field() }}
            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el año --}}
               <label for="title"> Año </label>
               <input name="year" type="text" class="form-control">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el director --}}
               <label for="title"> Director </label>
                <input name="director" type="text" class="form-control">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el poster --}}
                <label for="title"> Poster </label>
                <input name="poster" type="text" class="form-control">
            </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
               <label for="synopsis">Categoria</label>
               <select name="category" class="form-control" style="height:3rem">
               @foreach( $categorys as $category )
                  <option value="{{$category->id}}">{{$category->title}}</option> 
               @endforeach
               </select>
            </div>

            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Añadir película
               </button>
            </div>
   </form>
            {{-- TODO: Cerrar formulario --}}

         </div>
      </div>
   </div>
</div>

@stop