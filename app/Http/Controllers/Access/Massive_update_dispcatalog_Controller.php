<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Access;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Massive_update_dispcatalog_Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_batchserv') ] );

    }//construct

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

        return view('Access.massive_update_dispcatalog')-> with('menu',$menu); // test 2


    }

       protected function login()
    {

    }

    public function load()
    {
        $this->loginResponse = $this->login();
        $file = request()->file('file');

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
                            'data-error' => 'Valor inv�lido',
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


            loginfo("sisten test1");
            loginfo($sJL_resupload);
            loginfo("sisten test2");
            //remove

            /*$result_data[]= array(
                'result_opp' => $sJL_resupload
                );*/

            loginfo("sisten test3");
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

        loginfo("sisten exec 1");
        $json = request()->json()->all();
        loginfo($json);


        $responsexec = NULL;
        try {
            loginfo("sisten exec 2");
            $responsexec = $this->httpClient->request('POST',config('conf.url_batchserv').'cgi-bin/boveda/master_catalogo.cgi',
                [
                    'headers'  => [ 'Content-type' => 'Application/json' ],
                    'json' => $json
                ]);

            loginfo("sisten exec 3");
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_batchserv').'cgi-bin/boveda/master_catalogo.cgi', [$responsexec->getBody()]);

            //inicio
            loginfo("sisten exec 4");
            $sJL_resupload = implode([html_entity_decode(utf8_decode($responsexec->getBody()))]);
            loginfo($sJL_resupload);
            loginfo("sisten exec 5");
            //fin

            //return json_encode([$responsexec->getBody()]);
            return $sJL_resupload;



        }catch(\Exception $exception){
            loginfo("sisten exec 5");
            loginfo('Exception http code: '.$exception->getMessage() );
            //$responsexec = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_batchserv').'upload.php'
                .'statusCode '. $exception
                , $exception );

            loginfo("sisten exec 6");
            return json_encode([ 'error' => parse_exception( $exception ),
                'statusCode' => $exception
            ]);
        } // Try
    }// execute


} //Massive_Batch_Controller
