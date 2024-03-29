<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Batch;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Usermana};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Massive_Batch_Cambio_Endsec extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_batchserv') ] );

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

        return view('Batch.massive_batch_Endsec')-> with('menu',$menu); // test 2


    }

       protected function login()
    {

    }

    public function load()
    {
        $this->loginResponse = $this->login();
        $file = request()->file('file');

        //loginfo($file->getClientOriginalName());
        //loginfo($file);
        $response = NULL;
        try {

            $response = $this->httpClient->request('POST',config('conf.url_batchserv').'upload.php',
                [
                    'multipart' =>
                    [
                        [
                            'name' => 'archivos[]',
                            'class'=> 'form-control',
                            'placeholder' => 'Archivo',
                            'data-error' => 'Valor invalido',
                            'filename' => $file->getClientOriginalName(),
                            'contents' => fopen($file, 'r')
                        ]
                    ]
                ]);

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_batchserv').'upload.php', [$response->getBody()]);

            //$sJL_resupload = implode([str_replace(array("\n","\r"),'',$response->getBody())]);
            //$sJL_resupload = implode([$response->getBody()]);
            //$sJL_resupload = implode([]);
            $sJL_resupload = implode([html_entity_decode(utf8_decode($response->getBody()))]);

            loginfo($sJL_resupload);
            //remove

            /*$result_data[]= array(
                'result_opp' => $sJL_resupload
                );*/

            //return json_encode();
            return $sJL_resupload;

        }catch(\Exception $exception){
            loginfo('Exception http code: '.$exception->getMessage() );
            //$response = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.'http://34.232.219.112/upload.php'
                .'statusCode '. $exception
                , $exception );

            return json_encode([ 'error' => parse_exception( $exception ),
                'statusCode' => $exception
            ]);
        } // Try
    }// load

    public function execute()
    {
        loginfo('Obtiene Datos del API para el reporte: ');

        $json = request()->json()->all();
        loginfo($json);


        $responsexec = NULL;
        try {
            $responsexec = $this->httpClient->request('POST',config('conf.url_batchserv').'cgi-bin/boveda/buscarcv3_boveda.cgi',
                [
                    'headers'  => [ 'Content-type' => 'Application/json' ],
                    'json' => $json
                ]);

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_batchserv').'cgi-bin/boveda/buscarcv3_boveda.cgi', [$responsexec->getBody()]);

            //inicio
            $sJL_resupload = implode([html_entity_decode(utf8_decode($responsexec->getBody()))]);
            loginfo($sJL_resupload);
            //fin

            //return json_encode([$responsexec->getBody()]);
            return $sJL_resupload;



        }catch(\Exception $exception){
            loginfo('Exception http code: '.$exception->getMessage() );
            //$responsexec = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_batchserv').'upload.php'
                .'statusCode '. $exception
                , $exception );

            return json_encode([ 'error' => parse_exception( $exception ),
                'statusCode' => $exception
            ]);
        } // Try
    }// execute


} //Massive_Batch_Controller
