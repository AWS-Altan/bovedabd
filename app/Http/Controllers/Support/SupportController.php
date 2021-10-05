<?php

namespace App\Http\Controllers\Support;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Entities\{Usermana};
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

        loginfo('Version 2020/10/05');
        

        try {
            loginfo('envio a pass');
            loginfo($json);

            $req = json_decode($this->httpClient->request('POST',config('conf.url_login_bob'). 'slogin', [
            //$req = json_decode($this->httpClient->request('POST','https://ch9o1fia6l.execute-api.us-east-1.amazonaws.com/test/boveda-login', [
            
                    'json' => $json
                  ])->getBody(),true);

            loginfo('Login response' . config('conf.url_login_bob') . 'slogin', [$req]);
            $sJLstring = implode(",", [$req][0]);
            $arrJLlogin = explode(',', $sJLstring);
            $sJLstatus = $arrJLlogin[0];            
            $sJLnombre = $arrJLlogin[1];
            $sJLnivel = $arrJLlogin[2];
            $sJLEstado = $arrJLlogin[3];            
            $sJLmail = $arrJLlogin[4];
            $sJLfecha_termino = $arrJLlogin[5];
            $sJLdetails = $arrJLlogin[6];
            $sJLflagsys = $arrJLlogin[7];
            $sJLno_disp = $arrJLlogin[8];
            $sJLsysus   = $arrJLlogin[9];
            $sJLdisp    = $arrJLlogin[10];
            $sJLfsys_inicio = $arrJLlogin[11];
            $sJLfsys_fin = $arrJLlogin[12];
            
          
            loginfo("Acceso: ".$sJLstatus." level:".$sJLnivel." correo:".$sJLmail." nombre:" . $sJLnombre." fecha_termino: ".$sJLfecha_termino." Detalles:".$sJLdetails." flagsys:".$sJLflagsys." no_disp:".$sJLno_disp." sysus:".$sJLsysus." disp:".$sJLdisp." sys_inicio:".$sJLfsys_inicio." sys_fin:".$sJLfsys_fin);


            //$resp = Usermana::where( 'mail', request()->email )->first();
            $resp = Usermana::where([['email','=',request()->email],['id_estado','=','1']]  )->first();            
            
            /*tabla view users en proceso de borrado*/
            $resp2 = Usermana::where( 'email', request()->email )->first();

            if ($sJLstatus == "ok")
            {
                loginfo('Login exitoso del usuario ', [request()->email]);
                $new_session = \Session::getId();

                /*tabla view users en proceso de borrado*/
                if (is_null($resp)) 
                {
                    loginfo('se crea el registro del usuario para bitacora ', [request()->email]);
                    /*Vwuser::create([
                        'name' => $sJLnombre,
                        'vwrole_id' => $sJLnivel,
                        'mvno_id' => "1",
                        'email' => request()->email,
                        'active' => "1"
                    ]);
                    $resp2 = Vwuser::where( 'email', request()->email )->first();*/
                }

                $resp->last_session_id = $new_session;
                $resp->save();
                $new_session = \Session::getId();
                session()->put('idsession', $new_session);
                session()->put('email',request()->email);
                session()->put('user_nivel',$sJLnivel);
                session()->put('user_name',$sJLnombre);
                session()->put('user_estado',$sJLEstado);
                session()->put('user_fecha_termino',$sJLfecha_termino);
                session()->put('user_details',$sJLdetails);
                session()->put('user_flagsys',$sJLflagsys);
                session()->put('user_no_disp',$sJLno_disp);
                session()->put('user_sysus',$sJLsysus);
                session()->put('user_disp',$sJLdisp);
                session()->put('user_fsys_inicio',$sJLfsys_inicio);
                session()->put('user_fsys_fin',$sJLfsys_fin);

                /*tabla view users en proceso de borrado*/
                $resp2->last_session_id = $new_session;
                $resp2->password = Hash::make( request()->password );
                $resp2->save();

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

    /*public function reset()
    {
        //$res = Usermana::where( 'id', app('auth')->user()->id )->first();
        $res->password = Hash::make( request()->password );
        $res->active = 1;
        $res->save();
        loginfo('cambio de contraseña primera vez del usuario ', [app('auth')->user()->id]);
        return redirect('/logout');
    }*/

}
