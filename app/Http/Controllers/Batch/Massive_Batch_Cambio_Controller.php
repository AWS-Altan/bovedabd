<?php

//cambio el namepace de acuerdo al directorio
namespace App\Http\Controllers\Batch;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;

use App\Entities\{Vwuser, mvno, Vwcredential, VwfileTemplates};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class Massive_Batch_Cambio_Controller extends BaseController
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

        return view('Batch.massive_batch_cambio')-> with('menu',$menu); // test 2


    }

       protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
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
                            'data-error' => 'Valor inválido',
                            'filename' => $file->getClientOriginalName(),
                            'contents' => fopen($file, 'r')
                        ]
                    ]
                ]);

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_batchserv').'upload.php', [$response->getBody()]);

            $sJL_resupload = implode([$response->getBody()]);

            $result_data[]= array(
                'result_opp' => $sJL_resupload
                );
            return json_encode($result_data);
            //return [$response->getBody()];

        }catch(\Exception $exception){
            loginfo('Exception http code: '.$exception->getMessage() );
            //$response = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.'http://34.232.219.112/upload.php'
                .'statusCode '. $exception
                , $exception );

            return json_encode([ 'error' => parse_exception( $exception ),
                'statusCode' => $exception
            ]);
        }



    }


} //Massive_Batch_Controller
