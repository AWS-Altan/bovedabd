<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Entities\{Vwuser, mvno, Vwcredential, Vwlogs};

use Hash;
use Password;

class CallsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $httpClient, $loginResponse;


    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_operation') ] );
    }

    protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
    }

    public function consultareport()
    {
        $this->loginResponse = $this->login();
        $msisdns = explode(',', request()->value);
        $results  = [];

        foreach ($msisdns as $value) {
            try {
                $req = json_decode($this->httpClient->request('GET', config('conf.url_360').'subscribers/'. $value .'/profile', [ 
                        'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. $value .'/profile', [$req]);
                $results[] = $req;
            } catch (\Exception $e) {
                loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'subscribers/'. $value .'/profile', [ parse_exception( $e ) ]);
            }
        }

        return collect($results);
    }

    public function consultaorder()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_ac').'orders/'.request()->value, [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_ac').'orders/'.request()->value, [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'GET '.config('conf.url_ac').'orders/'.request()->value,
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Consulta Estado Orden',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_ac').'orders/'.request()->value, [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'GET '.config('conf.url_ac').'orders/'.request()->value,
                    "responses" => json_encode($req),
                    "action_low" => 'Consulta Estado Orden',
                    "resoponse_low" => json_encode($req)
                ]);

        return json_encode( ['status' => $req->status] );
    }

    public function consultapreregistro()
    {
        $this->loginResponse = $this->login();
        loginfo('Entra a consulta de preregistro');

        $queryParam = null;
        $value=null;
        if ( strlen( request()->value) > 0) {
            loginfo("consulta x  msisdn");
            $queryParam='msisdn';
            $value=request()->value;
        }elseif ( strlen( request()->idPreregistered) > 0 ) {
            loginfo("consulta x  preregistered");
            $queryParam='preregisteredId';
            $value=request()->idPreregistered;
        }
        
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_ac'). 'getPreregistrations', [
                    'query' => [ 
                                 $queryParam => sprintf('%s', $value)
                               ] ,
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
                ]) -> getBody() );

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_ac').'getPreregistrations', [$req] );

           
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'GET '.config('conf.url_ac').'getPreregistrations',
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Consulta Pre Registro Alta',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_ac').'getPreregistrations'.' statusCode '.$e->getResponse()->getStatusCode(), [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 
                'value' => request()->value ,
                'statusCode' => $e->getResponse()->getStatusCode()
            ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'GET '.config('conf.url_ac').'getPreregistrations',
                    "responses" => substr(json_encode($req),0,254),
                    "action_low" => 'Consulta Pre Registro Alta',
                    "resoponse_low" => json_encode($req)
                ]);
          
       return json_encode( $req );
    }

    public function consulta()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_ac').'scheduledOrders?msisdn='.request()->value, [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_ac').'scheduledOrders?msisdn='.request()->value, [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'GET '.config('conf.url_ac').'scheduledOrders?msisdn='.request()->value,
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Consulta Estado Orden A Futuro',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_ac').'scheduledOrders?msisdn='.request()->value, [ parse_exception( $e ) ]);
            return collect();
        }
        
        return collect( $req->data );
    }

   public function consultacambiovinculacion()
    {
         $this->loginResponse = $this->login();
         $be_id=app('session')->get('choose_mvno')->partnerId;
         $value= request()->value;
         

        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_operation').'msisdns/'.$value.'/linkings?be_id='.$be_id
                , [
                    'headers' => [  
                                      'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) 
                                  ] 
                 ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'msisdns/'.request()->value.'/linkings?be_id='.$be_id, [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'GET '.config('conf.url_operation').'msisdns/'.request()->value.'/linkings?be_id='.$be_id,
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Consulta Cambio de Vinculación',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'msisdns/'.request()->value.'/linkings?be_id='.$be_id, [ parse_exception( $e ) ]);
            //return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
            return json_encode([ 'error' => parse_exception( $e ),
                 'value' => request()->value, 
                'statusCode' => $e->getResponse()->getStatusCode()
            ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'GET '.config('conf.url_operation').'msisdns/'.request()->value.'/linkings?be_id='.$be_id,
                    "responses" => json_encode($req),
                    "action_low" => 'Consulta Cambio de Vinculación',
                    "resoponse_low" => json_encode($req)
                ]);

        return json_encode( $req );
    }

   public function cambiovinculacion()
    {
         $this->loginResponse = $this->login();
         $value= request()->value;
         $coordinates=request()->coordinates;

        loginfo('Entra cambio de Vinculación');
        loginfo('MSISDN:' . $value . ' coordinates:'. $coordinates );

        try {
            $req = json_decode($this->httpClient->request('PATCH', config('conf.url_operation').'subscribers/'.request()->value
                , [
                    'json'    => [ 'updateLinking' => [ 'coordinates' => request()->coordinates ] ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
                  ])->getBody());

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value);

        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value,
                        "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                        ,
                        "action_low" => 'Cambio de Vinculación',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value
                , [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ),
                 'value' => request()->value, 
                'statusCode' => $e->getResponse()->getStatusCode()
            ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value,
                    "responses" => json_encode($req),
                    "action_low" => 'Cambio de Vinculación',
                    "resoponse_low" => json_encode($req)
                ]);

        return json_encode( $req );
    }

    public function cambioMSISDN()
    {
         $this->loginResponse = $this->login();
         $value= request()->value;

        loginfo('Entra cambio de MSISDN');
        loginfo('MSISDN:' . $value . ' nir:'. request()->nir .' msisdnType:'.request()->msisdnType);
        

        try {
            $req = json_decode($this->httpClient->request('PATCH', config('conf.url_operation').'subscribers/'.request()->value
                , [
                    'json'   => [ 'changeSubscriberMSISDN' => 
                                                            [ 'nir'         => request()->nir,
                                                               'msisdnType' => request()->msisdnType
                                                             ] 
                                 ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
                  ])->getBody());

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value, [$req]);

        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value,
                        "responses" =>  strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                         ,
                        "action_low" => 'Cambio de MSISDN',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value
                , [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ),
                 'value'      => request()->value, 
                 'nir'        => request()->nir,
                 'msisdnType' => request()->msisdnType,
                'statusCode'  => $e->getResponse()->getStatusCode()
            ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value,
                    "responses" => json_encode($req),
                    "action_low" => 'Cambio de MSISDN',
                    "resoponse_low" => json_encode($req)
                ]);

        return json_encode( $req );
    }

    public function apn()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('POST', config('conf.url_360').'subscribers/'.request()->value.'/apn', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'.request()->value.'/apn', [$req]);

        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'POST '.config('conf.url_360').'subscribers/'.request()->value.'/apn ',
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Acualizar APN',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.'subscribers/'.request()->value.'/apn', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_360').config('conf.url_360').'subscribers/'.request()->value.'/apn',
                    "responses" => json_encode($req),
                    "action_low" => 'Acualizar APN',
                    "resoponse_low" => json_encode($req)
                ]);
        return json_encode(['date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'datos' => $req]);
    }

    public function block()
    {
        $this->loginResponse = $this->login();
        $imei = str_pad(request()->value, 16, "0", STR_PAD_RIGHT);
        $imei = substr($imei, 0, -2);
        date_default_timezone_set('America/Mexico_City');
        $date = ( isset( request()->date ) ) ? 'body '.json_encode( [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ] ) : '' ;
    	try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'imei/'.$imei.'/lock', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'imei/'.$imei.'/lock'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'imei/'.$imei.'/lock', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'imei/'.$imei.'/lock', [$req]);
            }
    	} catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'POST '.config('conf.url_operation').'imei/'.$imei.'/lock '.$date,
                        "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                            ,
                        "action_low" => 'bloqueo de imei',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'imei/'.$imei.'/lock', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
    	}
        
    	Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'imei/'.$imei.'/lock '.$date,
                    "responses" => json_encode($req),
                    "action_low" => 'bloqueo de imei',
                    "resoponse_low" => json_encode($req)
                ]);
    	return json_encode(['date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'datos' => $req]);
    }

    public function unblock()
    {
        $this->loginResponse = $this->login();
        $imei = str_pad(request()->value, 16, "0", STR_PAD_RIGHT);
        $imei = substr($imei, 0, -2);
        date_default_timezone_set('America/Mexico_City');
        $date = ( isset( request()->date ) ) ? 'body '.json_encode( [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ] ) : '' ;
    	try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'imei/'.$imei.'/unlock', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'imei/'.$imei.'/unlock'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'imei/'.$imei.'/unlock', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'imei/'.$imei.'/unlock', [$req]);
            }
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'POST '.config('conf.url_operation').'imei/'.$imei.'/unlock'.$date,
                        "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                           ,
                        "action_low" => 'des-bloqueo de imei',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'imei/'.$imei.'/unlock', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }

        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'imei/'.$imei.'/lock '.$date,
                    "responses" => json_encode($req),
                    "action_low" => 'des-bloqueo de imei',
                    "resoponse_low" => json_encode($req)
                ]);
    	
    	return json_encode(['date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'datos' => $req]);
    }

    public function identify()
    {
        $this->loginResponse = $this->login();

        $type = (request()->type == 'icc') ? 'iccid' : request()->type;
        
        if(request()->type == 'imsi'){
            $apiEndpoint = config('conf.url_360').'subscribers/getSubscriberByImsi?imsi='.request()->value;
        }else{
            $apiEndpoint = config('conf.url_360').'subscribers/search?identifierType='.$type.'&identifierValue='.request()->value;
        }

        try {
            $req = json_decode($this->httpClient->request('GET', $apiEndpoint, [ 
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ],
                'connect_timeout' => 15
            ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.$apiEndpoint, [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.$apiEndpoint, [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'type' => request()->type, 'value' => request()->value, 'url' => $apiEndpoint ]);
        }
        return json_encode($req);
    }



    public function traffic_suspend()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');
        
        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/suspend', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/suspend'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/suspend', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/suspend', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/suspend', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode( [ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ] );
    }

    public function pre_deactivate()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/predeactivate', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/predeactivate'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/predeactivate', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/predeactivate', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/predeactivate', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode( [ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ] );
    }

    public function deactivate()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/deactivate', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/deactivate'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/deactivate', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/deactivate', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/deactivate', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ]);
    }

    public function traffic_resum()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/resume', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/resume'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/resume', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/resume', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/resume', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ]);
    }

    public function traffic_barring()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/barring', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/barring'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/barring', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/barring', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/barring', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ]);
    }

    public function unbarring()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');
        
        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/unbarring', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/unbarring'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/unbarring', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/unbarring', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/unbarring', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ]);
    }

    public function reactivation()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/reactivate', [
                    'json' => [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/reactivate'.json_encode([ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/reactivate', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/reactivate', [$req]);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/reactivate', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode( [ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ] );
    }

    public function replace_sim()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ){
                $req = json_decode($this->httpClient->request('PATCH', 'subscribers/'.request()->value, [
                    'json' => [ 
                        'changeSubscriberSIM' => [
                            'newIccid' => request()->newiccid,
                            'scheduleDate' => Carbon::parse( request()->date )->format('Ymd')
                        ]
                    ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.json_encode([ 'changeSubscriberSIM' => [ 'newIccid' => request()->newiccid, 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ] ]), [$req]);
            }else{
                $req = json_decode($this->httpClient->request('PATCH', 'subscribers/'.request()->value, [
                    'json' => [ 'changeSubscriberSIM' => [ 'newIccid' => request()->newiccid ] ], 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
                loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.json_encode([ 'changeSubscriberSIM' => [ 'newIccid' => request()->newiccid ] ]), [$req]);
            }

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value, [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ]);
    }

    public function supplementary_services()
    {
        $this->loginResponse = $this->login();
        
        $responseSupplementaryServices = null;

        loginfo("Entra a supplementary_services ...");
        $json = request()->json()->all();
        loginfo($json);

        
        try {
            $responseSupplementaryServices = $this->httpClient->request('POST', config('conf.url_ac').'landline/manage-services', [
                'headers' => ['Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken)],
                'json' => $json,
            ])->getBody();
            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_ac') . 'landline/manage-services', [$responseSupplementaryServices]);
        } catch (\Exception $e) {
            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_ac') . 'landline/manage-services', [parse_exception($e)]);
            $error = json_encode(['error' => parse_exception($e)]);
            return $error;
        }


        return $responseSupplementaryServices;

    }

   public function consulta_supplementaryservices()
    {
         $this->loginResponse = $this->login();
         $be_id=app('session')->get('choose_mvno')->partnerId;
         $value= request()->value;
         

        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_ac').'landline/'.$value.'/managedServices'
                , [
                    'headers' => [  
                                      'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) 
                                  ] 
                 ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_ac').'landline/'.request()->value.'/managedServices', [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'GET '.config('conf.url_ac').'landline/'.request()->value.'/managedServices',
                        "responses" => json_encode([ 'error' => parse_exception( $e )]),
                        "action_low" => 'Consulta Servicios Suplementarios',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_ac').'landline/'.request()->value.'/managedServices', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ),
                 'value' => request()->value, 
                'statusCode' => $e->getResponse()->getStatusCode()
            ]);
        }
        
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'GET '.config('conf.url_ac').'landline/'.request()->value.'/managedServices',
                    "responses" => json_encode($req),
                    "action_low" => 'Consulta Servicios Suplementarios',
                    "resoponse_low" => json_encode($req)
                ]);

        return json_encode( $req );
    }

    public function updateAPN()
    {
        loginfo("Entra a actualizar APN ...");

        $this->loginResponse = $this->login();
        
        $response = null;

        $partherID= request()->beId;
        loginfo("partherID". $partherID);
        
        $value= request()->value;
        loginfo("MSISDN". $value);

        
        try {
            $response = $this->httpClient->request('POST', config('conf.url_360').'subscribers/'. $value .'/apn-change', [
                'headers' => ['Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken)]
                ])->getBody();
            
            loginfo('user ' . app('auth')->user()->name . ' response ' .config('conf.url_360').'subscribers/'. $value .'/apn-change', [$response]);

        } catch (\Exception $e) {
            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_360').'subscribers/'. $value .'/apn-change', [parse_exception($e)]);
            $error = json_encode(['error'      => parse_exception($e),
                                  'statusCode' => $e->getResponse()->getStatusCode()
                                ]);
            return $error;
        }


        return $response;

    }

    public function control_resum()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        $date = ( isset( request()->date ) ) ? 'body '.json_encode( [ 'scheduleDate' => Carbon::parse( request()->date )->format('Ymd') ] ) : '' ;
        try {
            $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/resumespm', [ 
                    'json' => [ 'address' => request()->coordinates ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/resumespm'.json_encode([ 'address' => request()->coordinates ]), [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                        "vwuser_id" => app('auth')->user()->id,
                        "actions" => 'POST '.config('conf.url_operation').'subscribers/'.request()->value.'/resumespm'.$date,
                        "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                        ,
                        "action_low" => 'Reanudación de Suspensión por Control de Movilidad',
                        "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                    ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/resumespm', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'subscribers/'.request()->value.'/resumespm'.$date,
                    "responses" => json_encode($req),
                    "action_low" => 'Reanudación de Suspensión por Control de Movilidad',
                    "resoponse_low" => json_encode($req)
                ]);
        
        return json_encode([ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s') ]);
    }

    public function debug()
    {
        $this->loginResponse = $this->login();
        
        return response()->json([
            'Login' => $this->loginResponse, 
            'user' => app('auth')->user(), 
            'mvno' => app('session')->get('choose_mvno')
        ],200,[],JSON_PRETTY_PRINT );
    }

    public function valid()
    {
         $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('POST', config('conf.url_360').'subscribers/validatePreactive', [ 
                    'json' => [ 'identifierType' => 'msisdn', 'identifierValue' => request()->value ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/validatePreactive'.json_encode([ 'identifierType' => 'msisdn', 'identifierValue' => request()->value ]), [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'subscribers/validatePreactive', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode($req);

    }

    public function serviceability()
    {
        $this->loginResponse = $this->login();
        $coverageMBB='';
        $tipoConsulta='Consulta serviciabilidad';
        if ( request()->isMob ){ 
            $coverageMBB='&isMob='.request()->isMob;
            $tipoConsulta='Consulta coverageMBB';
        }
        loginfo($tipoConsulta);

        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_sqm').'network-services/serviceability?address='.request()->coordinates.$coverageMBB, [ 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());

            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_sqm').'network-services/serviceability?address='.request()->coordinates.$coverageMBB, [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_sqm').'network-services/serviceability?address='.request()->coordinates.$coverageMBB, [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->coordinates ]);
        }
        
        return json_encode( $req );
    }

    public function validchoose()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('POST', config('conf.url_360').'offerings/validateServiceability', [ 
                    'json' => [ 'offeringId' => request()->value, 'serviceability' => request()->serviceability ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'offerings/validateServiceability '.json_encode([ 'offeringId' => request()->value, 'serviceability' => request()->serviceability ]), [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'offerings/validateServiceability', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value, 'serviceability' => request()->serviceability ]);
        }
        
        return json_encode( $req );
    }

    public function validfeature()
    {

        $offeringId = request()->value;

        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('POST', config('conf.url_360').'offerings/validateFeatureFiff', [ 
                    'json' => [ 'offeringId' => strval($offeringId) ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
        } catch (\Exception $e) {
            
            return json_encode([ 'error' => parse_exception( $e ), 'value' => $offeringId ]);
        }
        
        return json_encode( $req );
    }

    public function validfeaturecambio()
    {
        $texto = request()->value;

        if ( $texto[2] == 1 or $texto[2] == '1'  ) {
            return json_encode( ['exito' => 'aplica la logica del segundo '.$texto[2].' digito '.request()->value] );
        }else{
            return json_encode( ['error' => 'NO aplica la logica del segundo '.$texto[2].' digito '.request()->value] );
        }
    }

    public function activation()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');
        
        try {
            $json['offeringId'] = request()->offer;

            if ( isset( request()->coordinates ) and strlen(request()->coordinates) > 2 ){
                $json['address'] = request()->coordinates;
            }
            if ( isset( request()->date2 ) ){
                $json['startEffectiveDate'] = Carbon::parse( request()->date2 )->format('Ymd');
            }
            if ( isset( request()->date3 ) ){
                $json['expireEffectiveDate'] = Carbon::parse( request()->date3 )->format('Ymd');
            }

            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ) {
               $json['scheduleDate'] = Carbon::parse( request()->date )->format('Ymd');
            }

            if ( isset( request()->idPoS )){
                $json['idPoS'] = request()->idPoS;
            }
            
            loginfo('user '.app('auth')->user()->name.' request '.config('conf.url_operation').'subscribers/'.request()->value.'/activate', [$json]);
            $req = json_decode($this->httpClient->request('POST', 'subscribers/'.request()->value.'/activate', [ 
                    'json' => $json,
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/activate', [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'subscribers/'.request()->value.'/activate body '.json_encode($json),
                    "responses" =>  strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                        ,
                    "action_low" => 'alta',
                    "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/activate', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => $json ]);
        }

        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'subscribers/'.request()->value.'/activate body '.json_encode($json),
                    "responses" => json_encode($req),
                    "action_low" => 'alta',
                    "resoponse_low" => json_encode($req)
                ]);
        
        return json_encode( ['date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id] );
    }

    public function profile()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('GET', 'subscribers/'.request()->value.'/profile', [ 
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value.'/profile', [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value.'/profile', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => request()->value ]);
        }
        
        return json_encode($req);

    }

    public function offert()
    {
        $this->loginResponse = $this->login();
       
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
            ])->getBody(), true);
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [substr(json_encode($req),0,254)]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ) ]);
        }

        foreach ($req['dataOfferings'] as $value) {
            $find = strpos($value['productName'], 'Default');
            if ( $value['offerType'] == 'Primary' and $find === false ) {
                try {
                    $valor = str_pad($value['defaultOffer'], 3, "0", STR_PAD_LEFT);
                    foreach ($req['dataOfferings'] as $prod) {
                        $fin = strpos($prod['productId'], $valor);
                        if ( $fin !== false ) {
                            $value['detail'] = $prod;
                        }
                        
                    }
                    if ( !array_key_exists('detail', $value) ) {
                        $value['detail'] = $value;
                    }
                    //$value['detail'] = $req['dataOfferings'][$value['defaultOffer']-1];
                    $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                } catch (\Exception $e) {
                    $value['detail'] = $value;
                    $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                }
                
            }
        }
        
        $response = [ 'products' =>  $product];
        
        return json_encode( $response );
    }

    public function offertsearch()
    {
        $this->loginResponse = $this->login();
        
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
            ])->getBody(), true);
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ) ]);
        }
        
        //dd($req['dataOfferings']);
        foreach ($req['dataOfferings'] as $value){
            if ( $value['offerType'] == 'Primary' and $value['offeringId'] === request()->value ){
                $buscar = $value;
            }
        }

        //dd($buscar);
        if (     !isset($buscar) 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL') )          == 'ALL' 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL HBB') )      == 'ALL HBB' 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MOBILITY') ) == 'ALL MOBILITY' 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MIFI') )     == 'ALL MIFI' 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MBB') )      == 'ALL MBB' 
              or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL TF') )       == 'ALL TF' 
             ) {
           
            loginfo("Entra caso1");

            $productFamily=$buscar['productFamily'];
            loginfo("productFamily::".$productFamily);      

            //Ofertas que no se deben incluir
            //$excludedOfferts=null;
            if ( strpos( $buscar['replacement'] , "(") ){
                $listOfferts=substr(  
                          $buscar['replacement']
                        , strpos( $buscar['replacement'] , "(")  +1
                        , ( ( strpos( $buscar['replacement'] , ")") - 1)  - strpos( $buscar['replacement'] , "(") )
                    );
                loginfo("listOfferts to exclude::".$listOfferts);
                $excludedOfferts=explode(",",$listOfferts );
                array_walk($excludedOfferts, function(&$valor, $llave) {
                    $valor = str_pad($valor, 3, "0", STR_PAD_LEFT);
                });
            }
      

            foreach ($req['dataOfferings'] as $value) {
               
                $find = strpos($value['productName'], 'Default');

                //Aplica el Product Family
                $isProductFamyly=true;
                if (
                    substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL HBB') )      == 'ALL HBB' 
                 or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MOBILITY') ) == 'ALL MOBILITY' 
                 or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MIFI') )     == 'ALL MIFI' 
                 or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL MBB') )      == 'ALL MBB' 
                 or substr( strtoupper( trim( $buscar['replacement'])) , 0 , strlen('ALL TF') )       == 'ALL TF' 
             
                ){
                     $isProductFamyly=( $value['productFamily']===$buscar['productFamily'] );

                }      

    

               // $loginfo("arreglo de ofertasout::".$OffertsWithOut );
                if ( $value['offerType'] == 'Primary' and $find === false and  $isProductFamyly ){
                    
                    try {
                        
                        $valor = str_pad($value['defaultOffer'], 3, "0", STR_PAD_LEFT);
                        //loginfo("defaultOffer::".$valor);
                        
                            $fin = strpos($value['productId'], $valor);
                            
                            $lastProductId=substr($value['productId'], (strlen($value['productId']) - 3) );
                            //loginfo("prod['productFamily']::".$value['productFamily']." value['productId']::".$value['productId']." lastProductId::".$lastProductId);

                            $existExcludedOfferts=false;
                            //loginfo("existExcludedOfferts::".$existExcludedOfferts);
                            if ( isset( $excludedOfferts) ) {
                                $existExcludedOfferts = in_array($lastProductId, $excludedOfferts);
                                //loginfo("existExcludedOfferts::".$existExcludedOfferts);
                                
                            }
                            
                            
                            if (  !$existExcludedOfferts ) {
                                //loginfo("Entra::". (!$existExcludedOfferts));
                                $value['detail'] = $value;
                                //$value['detail'] = $req['dataOfferings'][$value['defaultOffer']-1];
                                $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                            }
                            

                        
                        if ( !array_key_exists('detail', $value) ) {
                            $value['detail'] = $value;
                        }

                        
                    } catch (\Exception $e) {
                        $value['detail'] = $value;
                        $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                    }

                    
                }

            }
        }else{
            $idsbusqueda = explode(',', $buscar['replacement']);
            foreach ($idsbusqueda as $value) {
                $valor = str_pad($value, 4, "0", STR_PAD_LEFT);
                $busquedaproduct[] = $valor;
            }
            //dd($busquedaproduct);
            foreach ($busquedaproduct as $busqueda) {
                foreach ($req['dataOfferings'] as $value) {
                    $find = strpos($value['productName'], 'Default');
                    
                    $lastFourNumbersProductId=substr( $value['productId'], ( strlen($value['productId']) - strlen($busqueda)) );

                    if ( $value['offerType'] == 'Primary' and $find === false 
                        and ( strcmp($busqueda, $lastFourNumbersProductId)===0 )  
                    ) {    
                        try {
                            $valor = str_pad($value['defaultOffer'], 3, "0", STR_PAD_LEFT);
                        
                        //loginfo('Cambio replacement-'. $busqueda . ' productId-'.$value['productId'] .' DefaultOffert-'.$valor. ' offeringId-'.$value['offeringId'] .' - ' .$value['productName'] );
                        

                            foreach ($req['dataOfferings'] as $prod) {
                                $fin = strpos($prod['productId'], $valor);

                                $lastThreeNumbersProductId=substr( $prod['productId'], ( strlen($prod['productId']) - strlen($valor)) );
                               
                                if ( strcmp($valor, $lastThreeNumbersProductId)===0 ) {
                                    $value['detail'] = $prod;
                                }
                                
                            }
                            if ( !array_key_exists('detail', $value) ) {
                                $value['detail'] = $value;
                            }
                            //$value['detail'] = $req['dataOfferings'][$value['defaultOffer']-1];
                            $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                        } catch (\Exception $e) {
                            $value['detail'] = $value;
                            $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                        }
                    }
                }
            }
        }

        $response = [ 'products' =>  $product];
        
        return json_encode( $response );

    }

    public function offertsearchbuy()
    {
        $this->loginResponse = $this->login();
       
        try {
            $req = json_decode($this->httpClient->request('GET', config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] 
            ])->getBody(), true);
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ) ]);
        }

        //busca las caracteristicas de la oferta primaria del suscriptor para obtener su oferta dedault (defaultOffer)
        //dd($req['dataOfferings']);
        $product=null;
        foreach ($req['dataOfferings'] as $value){
            
            if ( $value['offerType'] == 'Primary' and $value['offeringId'] === request()->value ){
                $buscar = $value;
                
                //multiactivable offerts 
                $default = null;
                if ( strcmp($value['buyback'],'Y')===0 ){
                  //loginfo('entro a buyback::'.$value['productName'] );
                  $default = $value;
                  $default['detail'] = $value;
                  $product[$value['productFamily']][] = $default;  

                } 
                  

                //defaultOffert
                $valor = str_pad(trim($value['defaultOffer']), 3, "0", STR_PAD_LEFT);
                foreach ($req['dataOfferings'] as $prod) {
                    $subDefaultOffer=substr( $prod['productId'], ( strlen($prod['productId']) - strlen($valor)) );
                    $find = strpos($prod['productName'], 'DS');

                    if ( strcmp($valor, $subDefaultOffer)===0  && $find  ) {    
                        //loginfo('shortName::'. $prod['productName'] .' find::'.$find);
                        $default = $prod;
                        $default['detail'] = $prod;
                        $product[$value['productFamily']][] = $default;
                    }
                    
                }

            }
        }

        //Despues busca las ofertas suplementarias(optionalAttach) de la oferta primaria
        //dd($buscar);
        $idsbusqueda = explode(',', $buscar['optionalAttach']);
        foreach ($idsbusqueda as $value) {
            $valor = str_pad(trim($value), 4, "0", STR_PAD_LEFT);
            $busquedaproduct[] = $valor;
        }
        //dd($busquedaproduct);
        if ( $busquedaproduct[0] == 0000 ) {
            if (isset( $product )) {
                return json_encode( [ 'products' =>  $product ] );
            }
            return json_encode( [ 'products' =>  [] ] );
        }
        foreach ($busquedaproduct as $busqueda) {
            foreach ($req['dataOfferings'] as $value) {
                $find = strpos($value['productName'], 'Default');
                $subSuplementaryOffer=substr( $value['productId'], ( strlen($value['productId']) - strlen($busqueda)) );
                if ( strcmp($busqueda, $subSuplementaryOffer)===0 ) {
                    try {
                        if ( !array_key_exists('detail', $value) ) {
                            $value['detail'] = $value;
                        }
                        //$value['detail'] = $req['dataOfferings'][$value['defaultOffer']-1];
                        $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                    } catch (\Exception $e) {
                        $value['detail'] = $value;
                        $product[$value['productFamily']][] = $offerts[ $value['offeringId'] ] = $value;
                    }
                }
            }
        }

        $response = [ 'products' =>  $product];
        
        return json_encode( $response );
    }

    public function productchange()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');
        
        try {
            $json['offeringId'] = request()->offer;

            if ( isset( request()->coordinates ) and strlen(request()->coordinates) > 2 ){
                $json['address'] = request()->coordinates;
            }
            if ( isset( request()->date2 ) ){
                $json['startEffectiveDate'] = Carbon::parse( request()->date2 )->format('Ymd');
            }
            if ( isset( request()->date3 ) ){
                $json['expireEffectiveDate'] = Carbon::parse( request()->date3 )->format('Ymd');
            }
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ) {
               $json['scheduleDate'] = Carbon::parse( request()->date )->format('Ymd');
            }

            loginfo('user '.app('auth')->user()->name.' request '.config('conf.url_operation').'subscribers/'.request()->value, [$json]);
            $req = json_decode($this->httpClient->request('PATCH', 'subscribers/'.request()->value, [ 
                    'json' => [ 'primaryOffering' => $json ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'subscribers/'.request()->value, [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value.' body '.json_encode($json),
                    "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                    ,
                    "action_low" => 'cambio de producto',
                    "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'subscribers/'.request()->value, [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => $json ]);
        }

        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'PATCH '.config('conf.url_operation').'subscribers/'.request()->value.' body '.json_encode($json),
                    "responses" => json_encode($req),
                    "action_low" => 'cambio de producto',
                    "resoponse_low" => json_encode($req)
                ]);
        
        return json_encode( [ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ] );
    }

    public function productbuy()
    {
        $this->loginResponse = $this->login();
        date_default_timezone_set('America/Mexico_City');

        try {
            $json['offerings'] = [request()->offer];
            $json['msisdn'] = request()->value;
            if ( isset( request()->coordinates ) and strlen(request()->coordinates) > 2 ){
                //$json['address'] = request()->coordinates;
            }
            if ( isset( request()->date2 ) ){
                $json['startEffectiveDate'] = Carbon::parse( request()->date2 )->format('Ymd');
            }
            if ( isset( request()->date3 ) ){
                $json['expireEffectiveDate'] = Carbon::parse( request()->date3 )->format('Ymd');
            }
            if( isset( request()->date ) and !Carbon::parse( request()->date )->isToday() ) {
               $json['scheduleDate'] = Carbon::parse( request()->date )->format('Ymd');
            }
            if ( isset( request()->idPoS )){
                $json['idPoS'] = request()->idPoS;
            }

            loginfo('user '.app('auth')->user()->name.' request '.config('conf.url_operation').'products/purchase', [$json]);
            $req = json_decode($this->httpClient->request('POST', 'products/purchase', [ 
                    'json' =>  $json,
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_operation').'products/purchase', [$req]);
        } catch (\Exception $e) {
            Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'products/purchase body '.json_encode($json),
                    "responses" => strlen(json_encode([ 'error' => parse_exception( $e )]))>255 ?substr( json_encode([ 'error' => parse_exception( $e )]),0,254):json_encode([ 'error' => parse_exception( $e )])
                    ,
                    "action_low" => 'compra de producto',
                    "resoponse_low" => json_encode([ 'error' => parse_exception( $e )])
                ]);
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_operation').'products/purchase', [ parse_exception( $e ) ]);
            return json_encode([ 'error' => parse_exception( $e ), 'value' => $json ]);
        }

        Vwlogs::create([
                    "vwuser_id" => app('auth')->user()->id,
                    "actions" => 'POST '.config('conf.url_operation').'products/purchase body '.json_encode($json),
                    "responses" => json_encode($req),
                    "action_low" => 'compra de producto',
                    "resoponse_low" => json_encode($req)
                ]);
        
        return json_encode( [ 'date' => Carbon::parse($req->effectiveDate)->format('Y-m-d H:i:s'), 'order_id' => $req->order->id ] );
    }

}
