<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;
use App\Traits\GetFieldPermissions;
use App\Entities\{Vwuser, mvno, Vwcredential};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Carbon\Carbon;

class BatchOperationsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GetMenu, GetFieldPermissions;

    protected $httpClient, $loginResponse;

    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_batch') ] );
    }

    /**
	 *
	 *
	 * @return view
	 */
	public function index()
    {
        $menu = $this->get_menu();
        $permissions = $this->get_permissions();

        return view('operation.batch', ['menu' => $menu, 'permissions'=>$permissions] );
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
        $path = request()->path;
        $file = request()->file('file');

        $response = NULL;
        try {
            $response = $this->httpClient->request('POST', $path, [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken)
                                ], 'multipart' => [
                        [
                            'name' => 'archivos[]',
                            'filename' => $file->getClientOriginalName(),
                            'contents' => fopen($file, 'r')
                        ]
                    ]
                ]);

            loginfo('user '.app('auth')->user()->name.' response '.'https://altanredes-test.apigee.net'.$path, [$response->getBody()]);

            return json_encode(json_decode($response->getBody()));

        }catch(\BadResponseException $badresponseexception){
            loginfo('Fail with http code: '.$badresponseexception->getResponse()->getStatusCode());
            $response = $badresponseexception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.config('url_batch').$path
                , [parse_exception( $badresponseexception )]);
             return json_encode([ 'error' => parse_exception( $badresponseexception ),
                'statusCode' => $badresponseexception->getResponse()->getStatusCode()
            ]);
        }catch(\Exception $exception){
            loginfo('Exception http code: '.$exception->getMessage() );
            //$response = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' error '.config('url_batch').$path
                .'statusCode '. $exception->getResponse()->getStatusCode()
                , [parse_exception( $exception )]);

            return json_encode([ 'error' => parse_exception( $exception ),
                'statusCode' => $exception->getResponse()->getStatusCode()
            ]);
        }



    }
}
