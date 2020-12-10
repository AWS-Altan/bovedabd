<?php

namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Dispositivos, Vwcredential, VwfileTemplates, Vwlogs};

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
class AltaAccessController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    protected $httpClient, $loginResponse;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_catalogos') ] );
        
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

        return view('Access.altauser')-> with('menu',$menu); // test 2
    } // index

    /****************************
    Validación de sesion, si no esta logeado, lo manda a login
    *************************/
    protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), ['headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
    } //Login


    /****************************
    *    Funcion de Creación de Usuario
    *************************/
    public function newUser()
    {

        loginfo('Obtiene catalogos para el formulario de alta de usuario');

        $json = request()->json()->all();
        loginfo($json);


        try {

            $req = json_decode($this->httpClient->request('POST',config('conf.url_catalogos'). 'catalogos'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_catalogos') . 'catalogos', [$req]);

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_catalogos') .'catalogos'
                , [ parse_exception( $e ) ]);

            
        }

        return json_encode( $req );

    } // new_user


    public function getCatalogosList()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene catalogos para el formulario de alta de usuario');

        $json = request()->json()->all();
        loginfo($json);


        try {

            $req = json_decode($this->httpClient->request('POST',config('conf.url_catalogos'). 'catalogos'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_catalogos') . 'catalogos', [$req]);

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_catalogos') .'catalogos'
                , [ parse_exception( $e ) ]);

            
        }

        return json_encode( $req );
    }

}