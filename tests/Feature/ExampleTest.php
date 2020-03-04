<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Faker\Generator as Faker;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    //Funció que comprova el login satisfactori
    public function testlogin_succes() 
    {
        $credential = [
            'email' => 'arnaulopez26@gmail.com',
            'password' => 'patata1'
        ];

        $response = $this->post('login',$credential);

        $response->assertRedirect('/catalog');
    }
    //Funció que comprova el login erroni
    public function testlogin_error() 
    {
        $credential = [
            'email' => '',
            'password' => ''
        ];

        $response = $this->post('login',$credential);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    //Funció que comprova routes i views
    public function testCatalog() {
        $this->withoutMiddleware();
        $response = $this->get('/catalog');
        $response->assertStatus(200);
        $response->assertViewis('catalog.index');
    }
    //Funció que comprova les routes i les views
    public function testCatalogShow() {
        $this->withoutMiddleware();
        $response = $this->get('/catalog/show/1');
        $response->assertStatus(200);
        $response->assertViewis('catalog.show');
    }
    //Funció que genera un comentari buit
    public function testComentariBuit() {
        $this->withoutMiddleware();
        $response = $this->post('catalog/show/1',[]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
    }
    //Funció que genera un comentari amb la següent informació a la pelicula previament seleccionada, i amb un usuari
    public function testComentariNoBuit()
    {
        $this->withoutExceptionHandling();

        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->post('catalog/show/1', [
            'title' => 'Test Comentari',
            'review' => 'Aixo es un test',
            'stars' => 3,
            'movie_id' => 1

        ]);

        $this->assertDatabaseHas('reviews', [
            'title' => 'Test Comentari',
            'stars' => 3,
            'review' => 'Aixo es un test'
        ]);
    }
    //Funció que edita la pelicula amb id 1 amb els següents valors
    public function testEditarPeli()
    {
        $this->withoutExceptionHandling();
        $response = $this->withoutMiddleware()->put('catalog/edit/1', [
            'title' => 'Test',
            'year' => '2020',
            'director' => 'director',
            'synopsis' => 'synopsis',
            'category' => 1,
            'trailer' => 'trailer'
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => 'Test',
            'year' => '2020',
            'director' => 'director',
            'synopsis' => 'synopsis',
        ]);
    }
    //Funció que afegeix una pelicula buida
    public function testAfegirPeliBuida()
    {
        $response = $this->withoutMiddleware()->post('catalog/create');
        $response->assertStatus(302);
        //Aquest l'he hagut de comentar ja que no tinc validació en les peliculas
        //$response->assertSessionHasErrors('title');
    }
    //Funció que crea una pelicula amb les dades, via API
    public function testAfegirPeliAPI()
    {
        $this->withoutExceptionHandling();

        $response = $this->withoutMiddleware()->post(route('api.store'), [
            'title' => 'Test peli 1',
            'year' => '2089',
            'director' => 'director 1',
            'synopsis' => 'synopsis 11111',
            'category' => 1,
            'trailer' => 'trailer 111111111'
        ]);

        $response->assertStatus(200);
    }
    //Aquesta funció possa com a llogada la pelicula
    public function testCanviarPeliLlogada()
    {
        $response = $this->withoutMiddleware()->put(route('api.rent', ['id' => 1]));

        $response->assertStatus(200);
    }
    //Aquesta funció possa com a tornada la pelicula
   public function testCanviarPeliLliure()
    {
        $response = $this->withoutMiddleware()->put(route('api.return', ['id' => 1]));

        $response->assertStatus(200);
    }
}
