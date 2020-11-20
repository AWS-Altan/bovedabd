<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;


use Closure;

use App\Entities\{Vwuser, mvno, Vwcredential};

class Check360Session 
{
    /**
     * Handle an incoming request, check that the current session is the same that stored in vwusers.last_session_id.
     * By usiel.alvarado.e@altanredes.com
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $value = $request->path();

        $session_id = session()->get('idsession');
        $email = session()->get('email');

        $resp1 = Vwuser::where( 'email',  $email )->first();

        if($resp1 != null ){
            //loginfo('db_last_session_id: '.$resp1->last_session_id);
            if(  $session_id != null && $resp1->last_session_id != null && $resp1->last_session_id !=  $session_id ){
                loginfo('Sesion iniciada en otro navegador, saliendo...');
                session()->flush();
                return redirect('/logout');
            }
        }
        return $next($request);
    }
}
