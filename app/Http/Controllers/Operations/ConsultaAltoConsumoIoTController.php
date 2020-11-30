<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\GetMenu;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use App\Entities\{Vwuser, mvno, Vwcredential};

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
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient360->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
    }

	public function queryHighConsumptions( )
    {
		$this->loginResponse = $this->login();
		$mvno = request()->mvno;
		$response = NULL;

		loginfo('Lookup For MVNO['.$mvno.']' );
        try{
            loginfo('REQUEST: '.'cm-360/v1/mvnos/'. $mvno .'/recordIoT');
            $response = $this->httpClient360->request('GET', 'mvnos/'. $mvno .'/recordIoT', [
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ],
                'connect_timeout' => 120
            ]);
			loginfo('Datos obtenidos... ');
			loginfo($response);
        }catch(BadResponseException $exception){
            loginfo('Fail with http code: '.$exception->getResponse()->getStatusCode());
            $response = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' RESPONSE: '.'cm-360-pre/v1/mvnos/'. $mvno .'/recordIoT', [$response->getBody()]);
        }catch(\Exception $excGeneral){
            loginfo('Exception: ');
            loginfo($excGeneral);
        }

        //loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. request()->value .'/'.$path, [ $req ]);

        return $response->getBody();
    }
}
