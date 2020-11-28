<?php

//namespace App\Http\Controllers\Users;
namespace App\Http\Controllers\Users;

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
        loginfo(' mail:' . request()->send_email .
                ' password: ' . request()->send_password .
                ' usuario: ' . request()->send_username .
                ' id company:' . request()->send_id_company .
                ' id estado:' . request()->send_id_estado .
                ' id nivel:' . request()->send_id_nivel .
                ' id reesponsable:' . request()->send_id_responable .
                ' id solicitante:' . request()->send_id_solicitante .
                ' id credor:' . request()->send_id_createdby .
                ' creador:' . request()->send_createdby);
        //Inserto al log de la base
        Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'Alta de usaurio',
                        "responses" => 'test',
                        "action_low" => 'test2',
                        "resoponse_low" => 'test3'
                    ]);
        //Realizo insercion en el Catalogo
        try {
                Vwuser::create([
                        "name" => request()->send_username,
                        "vwrole_id" => "1",
                        "email" => request()->send_email,
                        "password" => Hash::make( request()->send_password),
                        "phone" => "55906438",
                        "active" => "0",
                        "last_session_id" => session()->get('idsession'),
                        "created_by" => request()->send_id_createdby,
                        "id_company" => request()->send_id_company,
                        "id_estado" => request()->send_id_estado,
                        "nivel" => request()->send_id_nivel,
                        "idresp" => request()->send_id_responable,
                        "id_solicitante" => request()->send_id_createdby

                ]); //Insercion
                $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200
                    ]);//json encode
            } catch (\Exception $e) {
                loginfo('Error al dar de alta el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'ok',
                                  'statusCode' => 200
                    ]);//json encode
            } //Try/Catch

            //regreso respuesta
        return $response;

    } // new_user


}
