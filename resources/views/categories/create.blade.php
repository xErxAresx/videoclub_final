@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Afegir categoria
         </div>
         <div class="card-body" style="padding:30px">
      <form method="POST">
         {{ csrf_field() }}            
            <div class="form-group">
               <label for="title">Title</label>
               <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="form-group">
               {{-- TODO: Completa el input para el año --}}
               <label for="title"> Description </label>
               <input name="description" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label for="director">Adult</label>
                <select name="adult" class="form-control"> 
                    <option value="false">Per tots els publics</option>
                    <option value="true">Per majors de 18 anys</option>
                </select>
            </div>
            <div class="form-group text-center">
               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Afegir categoria
               </button>
            </div>
      </form>
            {{-- TODO: Cerrar formulario --}}

         </div>
      </div>
   </div>
</div>

@stop