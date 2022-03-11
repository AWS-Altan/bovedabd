<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Batch;

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

class Report_Change_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        //$this->httpClient       = new Client( [ 'base_uri' => config('conf.url_repbatch') ] );        
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_repbatchcgi') ] );

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

        return view('Batch.Report_batch_change')-> with('menu',$menu); // test 2


    }

    protected function login()
    {

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
                elseif( request()->type == 'ip')
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

    public function search_data_api()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para el reporte: ');

        $json = request()->json()->all();
        loginfo($json);


        try {            
            //$req = json_decode($this->httpClient->request('POST',config('conf.url_repbatch'). 'reportebatch'
            $req = json_decode($this->httpClient->request('POST',config('conf.url_repbatchcgi'). 'reporte_batch.cgi'            
                , [                
                    'timeout' => 0,
                    'connect_timeout' => 0,
                    'json' => $json,
                    'headers' => [ 'Content-type' => 'Application/json','Autorization' => 'Bearer Qm92ZWRhMlJlbWVkeTpzNTY3bWtHNmVaNzl2VQ==' ]
                ])->getBody(),true);

            //loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_repbatch') . 'reportebatch', [$req]);            
            loginfo($req);
            loginfo('PASE');
        } catch (\Exception $e) {
            //loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbatch') .'reportebatch', [ $e ]);
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_repbatchcgi') .'reporte_batch.cgi', [ $e ]);            
        }
        loginfo('Regreso información');
        //return json_encode( $req );        
        //return json_decode(json_encode( $req ),true);
        return $req;

    }//search_data_api




} //Report_Batch_Controller



