<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Review;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notify;
use DB;

class CatalogController extends Controller
{
    public function getIndex() 
    {
		$peliculas=Movie::all();
        return view('catalog.index', array('peliculas'=> $peliculas));
    }

    public function getShow($id) 
    {
        $reviews=Review::all();
        $reviews = $reviews->where('movie_id', '=', $id);
        $pelicula=Movie::findOrFail($id);
        $category = Category::findOrFail($pelicula->category_id);
        return view('catalog.show', array('pelicula'=> $pelicula), array('reviews'=>$reviews), array('category'=>$category));
    }

    public function getCreate() 
    {
        $categorys = Category::all();
        return view('catalog.create',array('categorys'=>$categorys));
    }

    public function putEdit(Request $request, $id) 
    {
        $peli = Movie::findOrFail($id);
        $peli->title = $request->input('title');
        $peli->year = $request->input('year');
        $peli->director = $request->input('director');
        $peli->synopsis = $request->input('synopsis');
        $peli->category_id = $request->input('category');
        $peli->trailer = $request->input('trailer');
        $peli->save();
        Notify::success('La pelicula sea editat correctament');
        return $this->getShow($id);
    }

    public function postCreate(Request $request) 
    {
        Movie::create([
            'title' => $request['title'],
            'year' => $request['year'],
            'director' => $request['director'],
            'poster' => $request['poster'],
            'synopsis' => $request['synopsis'],
            'category_id' => $request['category'],
            'trailer' => $request['trailer']
        ]);
        Notify::success('La pelicula sea creat correctament');
        return redirect('/catalog');
        
    }

   public function getEdit($id) 
   {
        $pelicula=Movie::findOrFail($id);
        $categoria = Category::findOrFail($pelicula->category_id);
        $categorys = Category::all();
        return view('catalog.edit', array('pelicula'=> $pelicula), array('categorys'=>$categorys), array('categoria'=>$categoria));
    }

    public function putRent($id) 
    {
        $peli = new Movie;
        $peli2 = $peli -> findOrFail($id);
        $peli2->rented = 1;
        $peli2->save();

        $movie = Movie::findOrFail($id);
        $reviews=Review::all();
        $reviews = $reviews->where('movie_id', '=', $id);
        Notify::success('La pelicula sea llogat');
        return view('catalog.show',array('pelicula'=>$movie), array('reviews'=>$reviews));
    }

    public function putReturn($id) 
    {
        $peli = new Movie;
        $peli2 = $peli -> findOrFail($id);
        $peli2->rented = 0;
        $peli2->save();

        $movie = Movie::findOrFail($id);
        $reviews=Review::all();
        $reviews = $reviews->where('movie_id', '=', $id);
        Notify::success('La pelicula sea retornat');
        return view('catalog.show',array('pelicula'=>$movie), array('reviews'=>$reviews));
    }

    public function deleteMovie($id) 
    {
        $peli = new Movie;
        $peli2 = $peli->findOrFail($id);
        $peli2->delete();

        Notify::success('La pelicula sea eliminat');
        return redirect('/catalog');
    }

    public function postCreateR(Request $request, $id)
    {
        $user = auth()->user();

        $review=new Review();
        $review->title= $request->input('title');
        $review->stars= $request->input('stars');
        $review->review= $request->input('review');
        $review->movie_id= $id;
        $review->user_id= Auth::id();
        $review->save();
        Notify::success('La review ha sigut creada correctament');
        
        return $this->getShow($id);
    }
    //Aquesta funció busca les pelis que continguin aquests carecters intoduits i retorna una view on solament estan aquestes pelicules
    public function buscar(Request $request)
    {
        //Agafem el nom que pasa l'usuari
        $nom=$request->get('nom');
        // Despres busquem les pelicules aparti del nom
        $peliculas = Movie::where('title','like','%'.$nom.'%')->paginate(20);
        //Retornem la view de l'index amb les pelkcules corresponents
        return view('catalog.index', array('peliculas'=> $peliculas));
    }
    //Funció que retorna una view y una array on pasem la mitjana de puntució de les 3 millors pelicules
    public function rates()
    {
        //Creem una variable que sera la puntuació de les pelicules, es a dir la mitjana per cada una de elles
        $rates = Review::Select('movie_id',DB::raw('AVG(stars) as rates'))->groupby('movie_id')->get();
        //Despres les ordenem i agafem solament les 3 primeres
        $rates = collect($rates)->sortBy('rates')->reverse()->take(3);
        //Retornem a la view que hem creat i l'array que volem tractar
        return view('catalog.rates', array('rates'=>$rates));

    }
}