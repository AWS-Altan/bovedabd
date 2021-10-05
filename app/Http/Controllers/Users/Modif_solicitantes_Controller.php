<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Usermana, Vwlogs};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Modif_solicitantes_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_gui_user') ] );

    }

    /**
     * Show the Porta In.
     *
     * @return view
     */
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[2] ) )
            return redirect()->route('home.index');

        //return view('users.modif_user', ['menu' => $menu] );
        return view('Users.modif_solic')-> with('menu',$menu);
    }

       protected function login()
    {

    }

    public function search_user()
    {
        // Docs::where('active', 1)->orderBy('orderd', 'desc')->get() as $value
        // $products =  Vwproduct::select("producto")->whereIn('idproducto',$productUser)->get();

        loginfo('Busqueda de usuario');
        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {
                //consulta
                $boveda_user =  Usermana::where('email','=',request()->value)->get();

                foreach ($boveda_user as $user_bob) {
                    loginfo('name'.$user_bob->name);
                    loginfo('email'.$user_bob->email);

                    $response = json_encode(['description' => 'ok',
                                'statusCode' => 200,
                                'send_email' => $user_bob->email,
				                'send_password'	=> $user_bob->password,
				                'send_username'	=> $user_bob->name,
				                'send_id_company' => $user_bob->id_company,
				                'send_id_estado' => $user_bob->id_estado,
				                'send_id_nivel' => $user_bob->nivel,
                                'send_id_responable' => $user_bob->idresp,
				                'send_id_solicitante' => $user_bob->id_solicitante,
                                'send_Telefono' => $user_bob->phone

                    ]);//json encode

                } //for each


            } catch (\Exception $e) {
                loginfo('Error al consultar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'nok',
                                  'statusCode' => 400
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;


    } //search_user

    public function modif_user()
    {
        // Valido Sesion
        //$this->loginResponse = $this->login();
        loginfo('Alta de usuario');
        $json = request()->json()->all();
        loginfo($json);

        //Escribo al log
        // Escribo los datos de alta
        loginfo(' mail:' . request()->mail .
                ' nombre:'. request()->nombre.
                ' paterno:'. request()->paterno.
                ' materno:'. request()->materno.
                ' msisdn:'. request()->msisdn
                );



        //Escribo al log
        loginfo('inserte en logs');

        //hago la inserción por la API

        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_gui_user'). 'modif-solicic'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_gui_user') . 'modif-solicic', [$req]);
            loginfo('termina ejecución API');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_gui_user') .'modif-solicic', [ $e ]);


        }
        loginfo('Regreso información');
        //Inserto al log de la base
        Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'Alta_de_usaurio',
                        "responses" => 'test',
                        "action_low" => config('conf.url_gui_user'). 'alta-usuario',
                        "resoponse_low" => 'test3'
                    ]);
        return json_encode( $req );
    }//modif_user()

}
