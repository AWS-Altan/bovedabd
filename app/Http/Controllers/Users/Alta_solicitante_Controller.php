<?php

//namespace App\Http\Controllers\Users;
namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Vwlogs};

use Hash; //para el password


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;


/*******************************
 * Controlador de Alta de usuario
********************************/
class Alta_solicitante_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;
    /*******************************
     * Invocación de vista  de Alta de Usuario
     *
     *******************************/
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[2] ) )
            return redirect()->route('home.index');

        return view('Users.altasolicitante')-> with('menu',$menu); // test 2
    } // index

    /****************************
    Validación de sesion, si no esta logeado, lo manda a login
    *************************/
    protected function login()
    {

    } //Login


    /****************************
    *    Funcion de Creación de Usuario
    *************************/
    public function new_user()
    {



    } // new_user


}
