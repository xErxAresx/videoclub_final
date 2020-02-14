<?php

namespace App\Http\Controllers;

use App\Category;
use Notify;
use App\Movie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index',array('arrayCategories'=> $categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    public function createP(Request $request)
    {
        $category=new Category();
        $category->title= $request->input('title');
        $category->description= $request->input('description');
        if($request->input('adult')=="false")
        {
            $category->adult= false;
        }
        if($request->input('adult')=="true")
        {
            $category->adult= true;
        }
        $category->save();
        Notify::success('La categoria a sigut creada correctament'); 
        return redirect("/categories");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'adult' => $request['adult']
        ]);
        Notify::success('La categoria sea creat correctament');
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelis = Movie::all();
        $pelis = $pelis->where('category_id', '=', $id);
        return view('categories.show', array('pelis'=>$pelis));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('categories.edit', array('category'=> $category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editP(Request $request, $id)
    {
        $categories=Category::all();
        $category = Category::findOrFail($id);
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        if($request->input('adult')=="false")
        {
            $category->adult= false;
        }
        if($request->input('adult')=="true")
        {
            $category->adult= true;
        }
        $category->save();
        Notify::success('La categoria sea editat correctament');
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = new Category;
        $category = $category->findOrFail($id);
        $category->delete();

        Notify::success('La categoria sea eliminat');
        return redirect('/categories');
    }
}
