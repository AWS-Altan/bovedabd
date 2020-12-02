<?php

namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

//declaracion de datos a usar
use App\Entities\{Vwuser, mvno, Vwcredential, VwfileTemplates, Vwlogs};

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
class Alta_access_Controller extends BaseController
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
    public function new_user()
    {

        // Valido Sesion
        //$this->loginResponse = $this->login();

        //Escribo al log
        loginfo('Alta de usuario');
        // Escribo los datos de alta
        loginfo('ip:' . request()-> send_ip .
                'host:' . request()->send_host .
                'idtipo_disp:' . request()->send_idtipodisp .
                'idgrupo:' . request()->send_idgrupo .
                'usuario:' . request()->send_usuario .
                'idtipo:' . request()->send_idtipo .
                'id_status:' . request()->send_idstatus .
                'idperfil:' . request()->send_idperfil .
                'flag_rota:' . request()->send_idflag .
                'id_solicitante:' . request()->send_idsolicitante .
                'fecha_alta:' . request()->send_fechaalta .
                'fecha_rota:' . request()->send_fecharota .
                'fecha_termino:' . request()->send_fechaterm );








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
            $max_id = Vwuser::max('id_disp');
            loginfo('Valor max');
            loginfo($max_id);
            $max_id++;
        }catch (Exception $e) {

        }

        //Realizo insercion en el Catalogo
        try {
                Vwuser::create([
                        "id_disp" => $max_id,
                        "ip" => request()-> send_ip,
                        "host" => request()->send_host,
                        "idtipo_disp" => request()->send_idtipodisp,
                        "idgrupo" => request()->send_idgrupo,
                        "usuario" => request()->send_usuario,
                        "idtipo" => request()->send_idtipo,
                        "id_status" => request()->send_idstatus,
                        "idperfil" => request()->send_idperfil,
                        "flag_rota" => request()->send_idflag,
                        "id_solicitante" => request()->send_idsolicitante,
                        "fecha_alta" => request()->send_fechaalta,
                        "fecha_rota" => request()->send_fecharota,
                        "fecha_termino" => request()->send_fechaterm

                ]); //Insercion

                //Escribo al log
                loginfo('inserté usuario');

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
