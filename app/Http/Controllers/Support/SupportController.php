<?php

namespace App\Http\Controllers\Support;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Entities\{Vwuser, mvno, Vwcredential};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

use Hash;


/**********************
 *  Nombre: SupportController.php
 *  Descripción: Pantalla despues del login, muestra el cambio de contraseña si es el primer ingreso, o la pantalla de seleccion de los MVNOs si el usuario no tiene uno asignado
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

        $json = [
            'mail' => request()->mail,
            'passwd' => request()->passwd
        ];


        try {

            /*$req = json_decode($this->httpClient->request('POST',config('conf.url_login_bob'). 'boveda-login', [
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

*/
            $resp = Vwuser::where( 'email', request()->email )->first();
/*            if ($sJLstatus == "ok")
            {
                loginfo('Login exitoso del usuario ', [request()->email]);
                $new_session = \Session::getId();
                $resp->last_session_id = $new_session;
                $resp->save();

                $new_session = \Session::getId();

                session()->put('idsession', $new_session);
                session()->put('email',request()->email);

                if (is_null($resp->mvno_id)) {
                    return json_encode( [ 'mvno' => mvno::all() ]) ;
                }
                return  json_encode( [ 'mvno' => [mvno::find($resp->mvno_id)] ] );

            } //if
*/
        if(Hash::check(request()->password, $resp->password)){

                loginfo('Login exitoso del usuario ', [request()->email]);
                $new_session = \Session::getId();
                $resp->last_session_id = $new_session;
                $resp->save();

                $new_session = \Session::getId();

                session()->put('idsession', $new_session);
                session()->put('email',request()->email);

                if (is_null($resp->mvno_id)) {
                    return json_encode( [ 'mvno' => mvno::all() ]) ;
                }
                return  json_encode( [ 'mvno' => [mvno::find($resp->mvno_id)] ] );

            }


        } catch (\Exception $e) {
            loginfo($e);
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
