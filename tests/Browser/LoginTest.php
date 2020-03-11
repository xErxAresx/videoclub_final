<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            //Aqui fem el login
            $browser->visit('/videoclub/public/login')
            ->waitForText('Login')
            ->type('email', 'arnaulopez26@gmail.com')
            ->type('password', 'patata1')
            ->press('Login')
            ->assertPathIs('/videoclub/public/catalog')
            
            //Busquem pelicula que no existeix
            ->pause(2500) 
            ->type('nom','El hahas') 
            ->press('Buscar')
            
            //Busquem pelicula que si existeix
            ->pause(2500)
            ->type('nom','El padrino') 
            ->press('Buscar')
            
            //Mostrem la pelicula que hem buscat
            ->pause(2500)
            ->clickLink('El Padrino. Parte II')

            //Fem scroll cap a vall
            ->pause(2500)
            ->driver->executeScript('window.scrollTo(0, 1000);');
            
            //Generem el comentari
            $browser->type('title', 'Comentari generat per Dusk')
            ->select('stars', '5')
            ->type('review', 'Comentari generat per Dusk')
            ->press('Valorar')
            
            //Creem una pelicula nova
            ->pause(2500)
            ->clickLink('Nueva película')
            ->pause(2500)
            ->type('title', 'Test Dusk')
            ->type('year', '2020')
            ->type('director','Dusk test')
            ->type('poster', 'https://images.alphacoders.com/106/thumb-1920-1067995.jpg')
            ->type('synopsis', 'Dusk synopsis')
            ->select('category', 'drama')
            ->press('Añadir película')
            
            //Tancar sessió
            ->pause(2500)
            ->press('Cerrar sesión');
        });
    }
}
