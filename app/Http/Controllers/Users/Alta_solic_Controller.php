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
class Alta_solic_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_gui_user') ] );

    }

    /*******************************
     * Invocación de vista  de Alta de Usuario
     *
     *******************************/
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[2] ) )
            return redirect()->route('home.index');

        return view('Users.altasolic')-> with('menu',$menu); // test 2
    } // index

    /****************************
    Validación de sesion, si no esta logeado, lo manda a login
    *************************/
    protected function login()
    {

    } //Login


    /****************************
    *    Funcion de Creación de Usuario
     falta organizacion y suborganizacion
    *************************/
    public function new_user()
    {

        // Valido Sesion
        //$this->loginResponse = $this->login();
        loginfo('Alta de solitante');
        $json = request()->json()->all();
        loginfo($json);

        //Escribo al log
        // Escribo los datos de alta
        loginfo(' mail:' . request()->mail .
                ' nombre:'. request()->nombre.
                ' paterno:'. request()->paterno.
                ' materno:'. request()->materno.
                ' msisdn:'. request()->msisdn .
                ' id_company:'. request()->id_company .
                ' fecha_alta:'. request()->fecha_alta .
                ' fecha_termino:'. request()->fecha_termino .
                ' id_estado:'. request()->id_estado .
                ' nivel:'. request()->nivel .
                ' idresp:'. request()->idresp .
                ' id_org:'. request()->id_org .
                ' id_sub_org:'. request()->id_sub_org 
                );


                /*"nombre": "Gary",
                "paterno": "Hernandez",
                "materno": "Martinez",
                "msisdn": "5574612877",
                "id_company": "175",
                "mail": "gary.hernandez@altanredes.com",
                "fecha_alta": "2022-02-08 10:00:00",
                "fecha_termino": "2022-02-10 15:00:00",
                "id_estado": "1",
                "nivel": "1",
                "idresp": "43",
                "id_org": "1",
                "id_sub_org": "4"*/


        //Escribo al log
        loginfo('inserte en logs');

        //Inserto al log de la base
        /*Vwlogs::create([
            "vwuser_id" => app('auth')->user()->id,
            "actions" => 'Alta_de_solicitante',
            "responses" => 'test',
            "action_low" => config('conf.url_gui_solic'). 'alta-usuario',
            "resoponse_low" => 'test3'
        ]);*/

        //hago la inserción por la API
        //
        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_gui_solic'). 'solicitante_alta_usuario'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_gui_solic') . 'solicitante_alta_usuario', [$req]);
            loginfo('termina ejecución API');
            return json_encode($req);
            //return json_encode('OK');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_gui_solic') .'solicitante_alta_usuario', [ $e ]);
            return json_encode($e);

        }
        
        
        
        

    } // new_user

    /****************************
    * Funcion de Consulta de catalog
    *   tipo 4 - informacion de solciiotantes
    *mail

    {
        "type": "1",
        "mail": "claudia.fernandez@altanredes.com"
    }

    4 - info
    si no - nook

    5 - trae dominios permitidos por solicitantes / organizaciones que existen / subcatalogos / perfiles --- info alta
    6 - trae la info de lo que ya existe / consulta de datos

    
    *************************/
    public function calatog_view()
    {
        loginfo('Obtiene Datos del API para el catalogo: ');

        $json = request()->json()->all();
        loginfo($json);
        //hago la inserción por la API
        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_gui_user'). 'catalogo'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_gui_user') . 'catalogo', [$req]);
            loginfo('termina ejecución API');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_gui_user') .'catalogo', [ $e ]);
        }
        loginfo('Regreso información');
        return json_encode( $req );
    }

}
