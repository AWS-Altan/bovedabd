<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Usermana, Userplat};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Report_userdisp_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        $this->httpClient   = new Client( [ 'base_uri' => config('conf.url_repbatch') ] );
        $this->httpRepBaja  = new Client( [ 'base_uri' => config('conf.url_repbatc_baja') ] );
        $this->httpRepCamb  = new Client( [ 'base_uri' => config('conf.url_repbat_cambio') ] );
        $this->httpRepForce = new Client( [ 'base_uri' => config('conf.url_repbat_force') ] );
        $this->httpRepRota = new Client( [ 'base_uri' => config('conf.url_repbat_rotate') ] );
        $this->httpReptipdisp = new Client( [ 'base_uri' => config('conf.url_tipo_disp') ] );
        $this->httpRecpass = new Client( [ 'base_uri' => config('conf.url_pass_recup') ] );

    }

    /**
     * Show the Porta In.
     *
     * @return view
     */
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[23] ) )
            return redirect()->route('home.index');

        return view('Access.report_userdisp')-> with('menu',$menu); // test 2


    }

    protected function login()
    {

    }


    public function search_data_api()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para el reporte: ');


        $iJL_pagina = 1;
        $json = [
                    'type' => request()->type,
                    'mail' => request()->mail,
                    'page' => $iJL_pagina
                ];
        loginfo($json);


        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_repbatch'). 'consulta-usuarios-dispositivos'
                , [
                    'json' => $json,
                  ])->getBody());

            //loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbatch') . 'consulta-usuarios-dispositivos', [$req]);
            loginfo('termina ejecución API 1');
            $sJL_varanalis = json_decode(json_encode( $req ),true);
            loginfo($sJL_varanalis['status']);
            loginfo($iJL_pagina);
            $sJL_pagedata = str_replace ('[','',$sJL_varanalis['data']);
            $sJL_pagedata = str_replace (']','',$sJL_pagedata);
            loginfo(strlen($sJL_pagedata));
            while($sJL_varanalis['data'] != '[]')
            {
                $iJL_pagina = $iJL_pagina + 1;
                $json = [
                    'type' => request()->type,
                    'mail' => request()->mail,
                    'page' => $iJL_pagina
                ];

                loginfo($json);

                $req = json_decode($this->httpClient->request('POST',config('conf.url_repbatch'). 'consulta-usuarios-dispositivos'
                , [
                    'json' => $json,
                  ])->getBody());

                $sJL_varanalis = json_decode(json_encode( $req ),true);
                loginfo($sJL_varanalis['status']);
                if($sJL_varanalis['data'] != '[]')
                {
                    $sJL_pagedatanew = str_replace ('[','',$sJL_varanalis['data']);
                    $sJL_pagedatanew = str_replace (']','',$sJL_pagedatanew);
                    $sJL_pagedata = $sJL_pagedata.','.$sJL_pagedatanew;
                    loginfo(strlen($sJL_pagedata));
                }//if

            }//while
            $sJL_pagedata = '['.$sJL_pagedata.']';
            $sJL_varanalis['data'] = $sJL_pagedata;

            loginfo('Regreso información');
            return json_encode( $sJL_varanalis );

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbatch') .'consulta-usuarios-dispositivos', [ $e ]);
        }

        //echo json_encode(array_merge(json_decode($dados1, true),json_decode($dados2, true)));


    }//search_data_api

    /*********************************
    *
    **********************************/
    public function baja_api_call()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para la solicitud de Baja: ');

        //$json = request()->data;
        $json = request()->json()->all();
        loginfo($json);



        try {
            $req = json_decode($this->httpRepBaja->request('POST',config('conf.url_repbatc_baja')
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbatc_baja') , [$req]);
            loginfo('termina ejecución API de baja');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbatc_baja') , [ $e ]);


        }
        loginfo('Regreso información');
        return json_encode( $req );

    }//baja_api_call

    /*********************************
    *
    **********************************/
    public function cambio_api_call()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para la solicitud de cambio: ');
        loginfo('test2: ');
        $json = request()->json()->all();
        loginfo($json);


        try {
            $req = json_decode($this->httpRepCamb->request('POST',config('conf.url_repbat_cambio')
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbat_cambio') , [$req]);
            loginfo('termina ejecución API de Cambio');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbat_cambio') , [ $e ]);


        }
        loginfo('Regreso información');
        return json_encode( $req );

    }//cambio_api_call

    public function rotate_api_call()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para la solicitud de rotado: ');

        //$json = request()->data;
        $json = request()->json()->all();
        loginfo($json);

        try {
            $req = json_decode($this->httpRepRota->request('POST',config('conf.url_repbat_rotate').'bv-rotate'
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbat_rotate').'bv-rotate' , [$req]);
            loginfo('termina ejecución API de forzado de sesion');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbat_rotate').'bv-rotate' , [ $e ]);


        }
        return json_encode( $req );

    }


    public function session_force_call()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para el forzado de la sesion: ');

        $json = request()->json()->all();
        //$json = request()->data;
        loginfo($json);


        try {
            $req = json_decode($this->httpRepForce->request('POST',config('conf.url_repbat_force').'bv_endsession'
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbat_force').'bv_endsession' , [$req]);
            loginfo('termina ejecución API de forzado de sesion');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbat_force').'bv_endsession' , [ $e ]);


        }
        return json_encode( $req );
    }

    public function fun_get_tipo_Dispositivo()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del tipo de dispositivo: ');

        $json = request()->json()->all();
        //$json = request()->data;
        loginfo($json);


        try {
            $req = json_decode($this->httpReptipdisp->request('POST',config('conf.url_tipo_disp').'qry_tipo_dispositivo'
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_tipo_disp').'qry_tipo_dispositivo' , [$req]);
            loginfo('termina ejecución API de forzado de sesion');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_tipo_disp').'qry_tipo_dispositivo' , [ $e ]);


        }
        return json_encode( $req );
    }

    public function fun_pass_recup()
    {
        //$this->loginResponse = $this->login();

        loginfo('recupera password: ');

        $json = request()->json()->all();
        //$json = request()->data;
        loginfo($json);


        try {
            $req = json_decode($this->httpRecpass->request('POST',config('conf.url_pass_recup').'recupera'
                , [
                    'headers'  => [ 'Content-Type' => 'application/json' ],
                    'json' => $json
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_pass_recup').'qry_tipo_dispositivo' , [$req]);
            loginfo('termina ejecución API de forzado de sesion');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_pass_recup').'qry_tipo_dispositivo' , [ $e ]);


        }
        return json_encode( $req );
    }//fun_pass_recup

}



