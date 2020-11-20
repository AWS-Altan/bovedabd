<?php

namespace App\Http\Controllers\Support;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Entities\{Vwuser, mvno, Vwcredential};

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

    public function mvo(    )
    {
        loginfo('Validando....');
        try {
             $resp = Vwuser::where( 'email', request()->email )->first();
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
        loginfo('Login fail con los datos ', [ request()->email, request()->password ]);
        return json_encode(['error' => 'fail']);

    }

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
