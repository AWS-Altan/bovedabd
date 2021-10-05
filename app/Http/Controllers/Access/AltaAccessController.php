<?php

namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Dispositivos, Vwlogs};

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
        if ( isset( $menu[25] ) )
            return redirect()->route('home.index');

        return view('Access.altauser')-> with('menu',$menu); // test 2
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
    public function newUser()
    {
        $this->loginResponse = $this->login();

        $req = null;

        loginfo("Entra a Alta de  Usuario Dispositivos ...");
        //$json = request()->json()->all();
        loginfo ("parametros de usuario");


        $json = [   'ip'            => request()->ip,
                    'usuario'       => request()->usuario,
                    //'password'      => request()->password,
                    'idtipo_disp'   => request()->idTipoDispositivo,
                    'id_grupo'      => request()->idGrupo,
                    'flag_rota'     => request()->flagRotacionPassword,
                    'id_solicitante'=> request()->idSolicitante,
                    'id_tipo'       => request()->idTipoUsuario,
                    'id_perfil'     => request()->idPerfil,
                    'fecha_termino' => request()->fechaTermino,
                    'operacion'     => request()->operacion
                    ];

        loginfo($json);

        try {
            $req = $this->httpClient->request('POST', config('conf.url_boveda_user'), [
                //'headers' => ['Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken)],
                'json' => $json,
            ])->getBody();
            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_boveda_user') , [$req]);
        } catch (\Exception $e) {
            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_boveda_user') , [parse_exception($e)]);
            $error = json_encode(['error' => parse_exception($e)]);
            return $error;
        }


        return $req;

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
