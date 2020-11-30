<?php

/**********************
 *  Nombre: ConsultaController.php
 *  Descripción: Controlador de consulta
 *  Historial modificaciones: mantene
 *
 * *********************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GetMenu;

class ConsultaController extends Controller
{
    use GetMenu;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($isMob)
    {
        $menu = $this->get_menu();
        loginfo('Inicio_nume Menu ', $menu);
        if ( isset( $menu[53] ) )
            return redirect()->route('home.index');

        return view('consulta', ['menu' => $this->get_menu() , 'isMob' => $isMob ] );
    }
}
