@extends('layouts.master')

@section('content')

<div class="row" style="text-align:center">
<a  href="{{url('/categories/create')}}" type="button" class="btn btn-success" style="display:inline">Afegir Categoria</a>
        <div class="col-lg-12 margin-tb" style="margin-top:10px">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <div class="pull-right">

            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Adult</th>
            <th colspan="3">Action</th>
        </tr>
    @foreach ($arrayCategories as $category)
    <tr>
        <td>{{$category->title}}</td>
        <td>{{ $category->description }}</td>
    @if($category->adult)
    <td>Per majors d'edat</td>
    @else
    <td>Per tots els publics</td>
    @endif
        <td>
            <a href="{{ url('/categories/'.$category->id) }}" type="button" class="btn btn-success" style="display:inline">Mostrar</a>
            <a href="{{ url('/categories/'.$category->id.'/edit' ) }}" type="button" class="btn btn-warning" style="display:inline">Editar</a>
        </td>
        <td>
        <form action="{{action('CategoryController@destroy', $category->id)}}" method="POST" style="display:inline">
        {{ method_field('DELETE') }}
            {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="display:inline">
                    Eliminar categoria
                </button>
        </form>
    </tr>
    @endforeach
    </table>
@stop