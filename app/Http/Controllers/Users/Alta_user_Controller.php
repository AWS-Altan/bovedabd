<?php

//namespace App\Http\Controllers\Users;
namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Vwuser, Vwlogs};

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
class Alta_user_Controller extends BaseController
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

        return view('Users.altauser')-> with('menu',$menu); // test 2
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
        loginfo(' mail:' . request()->send_email .
                ' password: ' . request()->send_password .
                ' usuario: ' . request()->send_username .
                ' id company:' . request()->send_id_company .
                ' id estado:' . request()->send_id_estado .
                ' id nivel:' . request()->send_id_nivel .
                ' id reesponsable:' . request()->send_id_responable .
                ' id solicitante:' . request()->send_id_solicitante .
                ' id credor:' . request()->send_id_createdby .
                ' creador:' . request()->send_createdby .
                ' telefono:' . request()->send_Telefono);
        //Inserto al log de la base
        Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'Alta de usaurio',
                        "responses" => 'test',
                        "action_low" => 'test2',
                        "resoponse_low" => 'test3'
                    ]);
        //Escribo al log
        loginfo('inserte en logs');

        //traigo el maximo
        try{
            $max_id = Vwuser::max('id');
            loginfo('Valor max');
            loginfo($max_id);
            $max_id++;
        }catch (Exception $e) {

        }

        //Realizo insercion en el Catalogo
        try {
                $exception = Vwuser::create([
                        "id" => $max_id,
                        "name" => request()->send_username,
                        "vwrole_id" => "1",
                        "email" => request()->send_email,
                        "password" => Hash::make( request()->send_password),
                        "phone" => request()->send_Telefono,
                        "active" => "0",
                        "last_session_id" => session()->get('idsession'),
                        "created_by" => request()->send_id_createdby,
                        "id_company" => request()->send_id_company,
                        "id_estado" => request()->send_id_estado,
                        "nivel" => request()->send_id_nivel,
                        "idresp" => request()->send_id_responable,
                        "id_solicitante" => request()->send_id_createdby

                ]); //Insercion

                //Escribo al log
                loginfo('inserte usuario');

                $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200
                    ]);//json encode
            } catch (Exception $e) {
                loginfo('Error al dar de alta el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'NOk',
                                  'statusCode' => 400
                    ]);//json encode

                //Escribo al log
                loginfo('Error en insercion');
                loginfo($e->getMessage());
            } //Try/Catch

            //regreso respuesta
        return $response;

    } // new_user


}
