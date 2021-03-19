<?php

namespace App\Http\Controllers\Support;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Entities\{Vwuser};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

use Hash;


/**********************
 *  Nombre: SupportController.php
 *  Descripción: Pantalla despues del login, muestra el cambio de contraseña si es el primer ingreso, 
 *  Historial modificaciones:
 *
 * *********************/


class SupportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_login_bob') ] );

    }


    public function mvo(    )
    {
        loginfo('Validando....');

        $sJL_email64 = base64_encode(request()->email);
        $sJL_pass64 = base64_encode(request()->password);


        $json = [
            'mail' => $sJL_email64,
            'passwd' => $sJL_pass64
        ];

        loginfo('Version 2020/02/02 ');

        try {
            //$req = json_decode($this->httpClient->request('POST',config('conf.url_login_bob'). 'boveda-login', [
            $req = json_decode($this->httpClient->request('POST','https://ch9o1fia6l.execute-api.us-east-1.amazonaws.com/test/boveda-login', [
                    'json' => $json
                  ])->getBody(),true);

            loginfo('Login response' . config('conf.url_login_bob') . 'boveda-login', [$req]);
            $sJLstring = implode(",", [$req][0]);
            $arrJLlogin = explode(',', $sJLstring);
            $sJLstatus = $arrJLlogin[0];
            $sJLnivel = $arrJLlogin[1];
            $sJLdetails = $arrJLlogin[4];
            $sJLnombre = $arrJLlogin[5];

            loginfo("Acceso: " .  $sJLstatus . " level:" . $sJLnivel . " detalle:" . $sJLdetails . " nombre:" . $sJLnombre);


            $resp = Vwuser::where( 'email', request()->email )->first();
            if ($sJLstatus == "ok")
            {
                loginfo('Login exitoso del usuario ', [request()->email]);
                $new_session = \Session::getId();

                if (is_null($resp)) {

                    loginfo('se crea el registro del usuario para bitacora ', [request()->email]);
                    Vwuser::create([
                        'name' => $sJLnombre,
                        'vwrole_id' => $sJLnivel,
                        'mvno_id' => "1",
                        'email' => request()->email,
                        'active' => "1"
                    ]);
                    $resp = Vwuser::where( 'email', request()->email )->first();
                }



                $resp->last_session_id = $new_session;
                $resp->password = Hash::make( request()->password );
                $resp->save();


                $new_session = \Session::getId();

                session()->put('idsession', $new_session);
                session()->put('email',request()->email);
                
                return  json_encode( [ 'mvno' => '1' ] );

            } //if


        } catch (\Exception $e) {
            loginfo($e);
            loginfo(config('conf.url_login_bob').'boveda-login');
        }
        loginfo('Login fail con los datos ', [ request()->email, request()->password]);



        return json_encode(['error' => 'fail']);

    }//mvo

    public function parameters()
    {
        dd( '' );
    }

    public function reset()
    {
        $res = Vwuser::where( 'id', app('auth')->user()->id )->first();
        $res->password = Hash::make( request()->password );
        $res->active = 1;
        $res->save();
        loginfo('cambio de contraseña primera vez del usuario ', [app('auth')->user()->id]);
        return redirect('/logout');
    }

}
