<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;



class ConsultaAltoConsumoIoTController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GetMenu;

	protected $httpClient360, $loginResponse;

	public function __construct()
	{
		$this->httpClient360       = new Client(['base_uri' => config('conf.url_360')]);
	}

    /**
	 *
	 *
	 * @return view
	 */
	public function index()
    {
    	$menu = $this->get_menu();
    	if ( isset( $menu[52] ) )
    		return redirect()->route('home.index');

    	return view('operation.iot.consulta-alto-consumo', ['menu' =>$menu] );
	}

	protected function login()
    {

    }

	public function queryHighConsumptions( )
    {
		$this->loginResponse = $this->login();
		$response = NULL;

        try{
			loginfo('Datos obtenidos... ');
			loginfo($response);
        }catch(BadResponseException $exception){
            loginfo('Fail with http code: '.$exception->getResponse()->getStatusCode());
            $response = $exception->getResponse();

        }catch(\Exception $excGeneral){
            loginfo('Exception: ');
            loginfo($excGeneral);
        }

        //loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. request()->value .'/'.$path, [ $req ]);

        return $response->getBody();
    }
}
