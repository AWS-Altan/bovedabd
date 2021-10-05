<?php

namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Usermana, Vwlogs};

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
class Alta_userMan_Controller extends BaseController
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

        return view('Access.altauserman')-> with('menu',$menu); // test 2
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

        // Valido Sesion
        //$this->loginResponse = $this->login();

        //Escribo al log
        loginfo('Alta de usuario');
        // Escribo los datos de alta
        loginfo(
                    'nombre: ' . request()->send_name .
                    'appellido pat: ' . request()->send_apppat .
                    'appellido mat:' . request()->send_appmat .
                    'telefono: ' . request()->send_phone .
                    'correo:' . request()->send_mail
            );

        //Inserto al log de la base
        Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'Alta de usuario',
                        "responses" => 'test',
                        "action_low" => 'test2',
                        "resoponse_low" => 'test3'
                    ]);


        //Escribo al log
        loginfo('inserte en logs');

        //traigo el maximo
        try{
            $max_id = Usermana::max('iduser_bv');
            loginfo('Valor max');
            loginfo($max_id);
            $max_id++;
        }catch (Exception $e) {

        }


        //Realizo insercion en el Catalogo
        try {
                $status_insert = Usermana::create([
                    "iduser_bv" => $max_id,
                    "nombre" => request()->send_name,
                    "paterno" => request()->send_apppat,
                    "materno" => request()->send_appmat,
                    "msisdn" => request()->send_phone,
                    //"id_company" =>
                    "email" => request()->send_mail
                    //"fecha_alta" =>
                    //"fecha_termino" =>
                    //"id_estado"v
                    //"nivel" =>
                    //"idresp" =>
                ]); //Insercion

                //Escribo al log
                loginfo('inserté usuario');

                $this->reportable(function (CustomException $e) {
                        loginfo('Error larabel '.$e);
                });

                $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200
                    ]);//json encode
            } catch (\Exception $e) {
                loginfo('Error al dar de alta el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200
                    ]);//json encode
                //Escribo al log
                loginfo('Error en insercion');
                loginfo($e->getMessage());
            } //Try/Catch

            //regreso respuesta
        return $response;

    } // new_user


}
