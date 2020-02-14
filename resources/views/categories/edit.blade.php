@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Modificar categoria
         </div>
         <div class="card-body" style="padding:30px">
            <form method="POST">
            
            {{-- TODO: Abrir el formulario e indicar el método POST --}}
            {{ method_field('PUT') }}
            {{ csrf_field('') }}
            {{-- TODO: Protección contra CSRF --}}

            <div class="form-group">
               <label for="title">Title</label>
               <input type="text" name="title" id="title" class="form-control" value="{{$category->title}}">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el año --}}
               <label for="title"> Description </label>
               <input name="description" type="text" class="form-control" value="{{$category->description}}">
            </div>
            <div class="form-group">
                <label for="director">Adult?</label>
                <select id="adult" name="adult" id="adult" class="form-control"> 
                @if($category->adult)
                <option value="true">Per majors de 18 anys</option>
                  <option value="false">Per tots els publics</option>

                @else
                  <option value="false">Per tots els publics</option>
                  <option value="true">Per majors de 18 anys</option>
                @endif
                </select>
            </div>                  
            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar categoria
               </button>
            </div>
            </form>
            {{-- TODO: Cerrar formulario --}}

         </div>
      </div>
   </div>
</div>

@stop