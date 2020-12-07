<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Batch;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, mvno, Vwcredential, VwfileTemplates, Userplat};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Report_Batch_Controller extends BaseController
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
        if ( isset( $menu[23] ) )
            return redirect()->route('home.index');

        return view('Batch.Report_batch')-> with('menu',$menu); // test 2


    }

    protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
    }

    public function search_data()
    {
        // Docs::where('active', 1)->orderBy('orderd', 'desc')->get() as $value
        // $products =  Vwproduct::select("producto")->whereIn('idproducto',$productUser)->get();


        // Escribo los datos de alta
        loginfo('type:' . request()->type .
                ', value: ' . request()->value);

        try {


                if( request()->type == 'hostname')
                {
                    loginfo('Reviso Hostname:' . request()->value);
                    $boveda_userdisp =  Userplat::where('host','=',request()->value)->get();
                }
                elseif( request()->type == 'IP')
                {
                    loginfo('Reviso IP' . request()->value);
                    $boveda_userdisp =  Userplat::where('ip','=',request()->value)->get();
                }
                elseif( request()->type == 'username')
                {
                    loginfo('Reviso Username' . request()->value);
                    $boveda_userdisp =  Userplat::where('usuario','=',request()->value)->get();
                }
                else
                {
                    loginfo('Error al consultar tipo de dato');
                    $response = json_encode(['description' => 'NOK',
                                    'statusCode' => 400
                        ]);//json encode
                    return $response;
                }


                loginfo('Voy a consultar los datos');

                foreach ($boveda_userdisp as $user_bob) {
                    loginfo('sisfen registro');
                    $result_data[]= array(
                                'description' => 'ok',
                                'statusCode' => 200,
                                'send_id_disp' => $user_bob->id_disp,
                                'send_ip' => $user_bob->ip,
                                'send_host' => $user_bob->host,
                                'send_idtipodisp' => $user_bob->idtipo_disp,
                                'send_idgrupo' => $user_bob->idgrupo,
                                'send_usuario' => $user_bob->usuario,
                                'send_passw' => $user_bob->passw,
                                'send_idtipo' => $user_bob->idtipo,
                                'send_idperfil' => $user_bob->idperfil,
                                'send_idsolicitante' => $user_bob->id_solicitante,
                                'send_idstatus' => $user_bob->id_estatus,
                                'send_fechaIngreso' => $user_bob->fecha_ingreso,
                                'send_fechaupdate' => $user_bob->fecha_update,
                                'send_fechatermino' => $user_bob->fecha_termino,
                                'send_fechaerror' => $user_bob->fecha_error,
                                'send_file' => $user_bob->file,
                                'send_reintento' => $user_bob->reintento,
                                'send_errorplat' => $user_bob->error_de_plataforma,
                                'send_duracion' => $user_bob->duration,
                                'send_transactionid' => $user_bob->transaccion_id,
                                'send_status transaction' => $user_bob->estatus_transaccion
                        );

                } //for each
                $response = json_encode($result_data);


            } catch (\Exception $e) {
                loginfo('Error al consultar el dispositivo', [ $e->getMessage() ]);
                $response = json_encode(['description' => 'NOK',
                                  'statusCode' => 400
                    ]);//json encode
                return $response;
            } //Try/Catch

            //regreso respuesta
        return $response;
    }//search_data


} //Report_Batch_Controller