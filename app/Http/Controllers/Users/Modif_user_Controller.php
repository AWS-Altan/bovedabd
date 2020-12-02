<?php

namespace App\Http\Controllers\Users;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, mvno, Vwcredential, VwfileTemplates, Vwlogs};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Modif_user_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

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
        return view('Users.modif_user')-> with('menu',$menu);
    }

       protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
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
                $boveda_user =  Vwuser::where('email','=',request()->value)->get();

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

        //Escribo al log
        loginfo('Modificación de usuario');
        // Escribo los datos de alta
        loginfo(' mail:' . request()->send_email .
                ' usuario: ' . request()->send_username .
                ' id company:' . request()->send_id_company .
                ' id estado:' . request()->send_id_estado .
                ' id nivel:' . request()->send_id_nivel .
                ' id reesponsable:' . request()->send_id_responable .
                ' id solicitante:' . request()->send_id_solicitante .
                ' telefono:' . request()->send_Telefono);
        //Inserto al log de la base
        Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'Update',
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

                $exception = Vwuser::where('email', request()->send_email)
                ->update([
                        'name' => request()->send_username,
                        'phone' => request()->send_Telefono,
                        'id_company' => request()->send_id_company,
                        'id_estado' => request()->send_id_estado,
                        'nivel' => request()->send_id_nivel,
                        'idresp' => request()->send_id_responable,
                        'id_solicitante' => request()->send_id_createdby
                ]);

                //Escribo al log
                loginfo('actualice usuario');

                $response = json_encode(['description' => 'OK',
                                  'statusCode' => 200
                    ]);//json encode
            } catch (Exception $e) {
                loginfo('Error al actualizar el usuario', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'NOk',
                                  'statusCode' => 400
                    ]);//json encode

                //Escribo al log
                loginfo('Error en actualizacion');
                loginfo($e->getMessage());
            } //Try/Catch

            //regreso respuesta
        return $response;
    }//modif_user()

}
