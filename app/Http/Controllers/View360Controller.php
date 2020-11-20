<?php

/**********************
 *  Descripción: Controlador principal
 *  Historial modificaciones:
 *
 * *********************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GetMenu;
use App\Entities\Docs;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use App\Entities\{Vwuser, mvno, Vwcredential};
use DateTime;
use DatePeriod;
use DateInterval;
use GuzzleHttp\Exception\BadResponseException;

class View360Controller extends Controller
{
    use GetMenu;

    protected $httpClient, $loginResponse;

    public function __construct()
    {
        $this->httpClient       = new Client( [ 'base_uri' => config('conf.url_360') ] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        loginfo('user '.app('auth')->user()->name.' inicia llamado de apis back '.Carbon::now(), [ "numer" => request()->value ]);
        $identify = $this->identify();

        if ( isset( $identify->error) )
            return view('view360', [ 'menu' => $this->get_menu(), 'blank' => 0, 'error' => $identify->error, 'imei' => '' ] );

        $profile = $this->profile( $identify->msisdn );

        if ( isset( $profile->error) )
            return view('view360', [ 'menu' => $this->get_menu(), 'blank' => 0, 'error' => $profile->error, 'imei' => '' ] );

        $offert = $this->offert();

        $imei = $identify->imei;
        $imeidate = Carbon::now();
        $equipo = null;

        if ($imei != 'Información no encontrada'){
            try {
                $equipo = $this->historyequipo($imei);
            } catch (\Exception $e) {
                loginfo('user '.app('auth')->user()->name.' error en deviceInformation', [ $e->getMessage() ]);
                $equipo = null;
            }
        }


        loginfo('user '.app('auth')->user()->name.' termina llamado de apis back '.Carbon::now(), [ "number" => request()->value ]);


        $famili = 0;
        $primaryOfferingId = '';
        $primaryOfferingName = '';
        $freeUnits = [];
        //todo lo que sea por movilidad no mostrar acciones por movilidad
        foreach ( $profile->purchasedOfferings->offers as $value) {
            try {
                if ( isset( $offert[$value->offeringId] ) and $offert[$value->offeringId]['productFamily'] ==  'HBB') {
                    $famili = 1;
                    loginfo('user '.app('auth')->user()->name.' es un producto HBB ', [ "productFamily" => $offert[$value->offeringId]['productFamily'], "offeringId" => $value->offeringId, "offerts" => $profile->purchasedOfferings->offers ]);

                    $array[$value->offeringId] = $offert[$value->offeringId]['productFamily'];
                }

                if ( $offert[$value->offeringId]['offerType'] == 'Primary') {
                    $primaryOfferingId = strval($value->offeringId);
                    $primaryOfferingName = $offert[$value->offeringId]['productName'];
                }

                loginfo('oferta: '.$value->serviceType);
                if ( $value->serviceType == 'Datos') {
                    array_push($freeUnits, $value);
                }

            } catch (\Exception $e) {
                loginfo('user '.app('auth')->user()->name.'error en validacion de producto: ', [ $e->getMessage() ]);
                if ($famili == 0 and isset( $profile->subscriber->product ) and $profile->subscriber->product == 'HBB') {
                    $famili = 1;
                }
            }
        }

        $mov=null;
        if ($famili == 1){
            try {
                $mov = $this->historymovilidad($identify->msisdn);
                loginfo('Resultado de movilidad: ');
                loginfo($mov);
                if ( isset(json_decode($mov)->errorCode) ){
                    loginfo("Hay un error en respuesta de movilidad...");
                    $mov = [[],[]];
                }
            } catch (\Exception $e) {
                loginfo('user '.app('auth')->user()->name.' error en movilidad', [ $e->getMessage() ]);
                $mov = null;
            }
        }
        $isRenewable = $this->setIsRenewable($profile->purchasedOfferings->offers, $offert);

        $perfil = null;

        try {
            $perfil = json_decode($this->perfil($identify->msisdn));
            if(isset($perfil)){
                loginfo('Valor roaming(HSS): '.$perfil->roamSubscriptionInfo);
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en consulta de perfil HSS', [ $e->getMessage() ]);
            $perfil = null;
        }

        $kpiTs = null;
        if ( $identify->imsi != 'Información no encontrada'){
            try {
                $kpiTs = $this->getKpisTs($identify->imsi);
                if(isset($kpiTs)){
                    loginfo('Valor kpiTs: '.$kpiTs[0]->trafico_up);
                }
            } catch (\Exception $e) {
                loginfo('user '.app('auth')->user()->name.' error en consulta de kpiTs', [ $e->getMessage() ]);
                $kpiTs = null;
            }
        }

        $lastCoverage = null;

        try {
            $lastCoverage = $this->lastCoverage( $profile->subscriber->msisdn );
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en consulta de cobertura', [ $e->getMessage() ]);
            loginfo( 'lastCoverageError'.$e->getMessage() );
            $lastCoverage = null;
        }

        $validateApn = null;

        try {
            $validateApn = $this->validateApn( $profile->subscriber->msisdn );
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en consulta de validateApn', [ $e->getMessage() ]);
            $validateApn = null;
        }

        loginfo('user '.app('auth')->user()->name.' termina llamado de apis back '.Carbon::now(), [ "number" => request()->value ]);


        loginfo('Opciones disponibles para el usuario');
        loginfo($this->get_menu());

        return view('view360', [
            'menu'          => $this->get_menu(),
            'profile'       => $profile,
            'offertname'    => $offert,
            'blank'         => 1,
            'primario'      => 0,
            'equipo'        => $equipo,
            'perfil'        => $perfil,
            'avalid'        => array(),
            'famili'        => $famili,
            'imei'          => $imei,
            'imeidate'      => $imeidate,
            'mov'           => $mov,
            'isRenewable'   => $isRenewable,
            'primaryOfferingId'  => $primaryOfferingId,
            'primaryOfferingName' => $primaryOfferingName,
            'freeUnits' => $freeUnits,
            'kpiTs'     => $kpiTs,
            'lastCoverage'  => $lastCoverage,
            'validateApn'   => $validateApn
        ] );
    }

    public function viewpdf()
    {
        $doc = Docs::where( 'id',request()->pdf )->first();
        if ($doc->archivo == '[]') {
            return view('viewpdf', ['menu' => $this->get_menu(),'doc' => '' ] );
        }
        return view('viewpdf', ['menu' => $this->get_menu(),'doc' => json_decode( $doc->archivo )[0]->download_link] );
    }

    protected function login()
    {
        $credential = Vwcredential::where('vwrole_id', app('auth')->user()->vwrole_id)->where('mvno_id', app('session')->get('choose_mvno')->id)->first();
        $Authorization =  "Basic ".base64_encode($credential->ClientId.":".$credential->SecretKey) ;
        return json_decode($this->httpClient->request('POST', config('conf.url_login'), [
                'headers'  => [ 'Authorization' => $Authorization ] ] )->getBody());
    }

    public function identify()
    {
        $this->loginResponse = $this->login();
        $type = (request()->type == 'icc') ? 'iccid' : request()->type;

        $val = request()->value;

        try {
            $req = json_decode($this->httpClient->request('GET', 'subscribers/search?identifierType='.$type.'&identifierValue='.$val, [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/search?identifierType='.$type.'&identifierValue='.$val, [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'subscribers/search?identifierType='.$type.'&identifierValue='.$val, [ parse_exception( $e ) ]);
            $error = json_encode([ 'error' => parse_exception( $e ) ]);
            return json_decode($error);
        }

        return $req;
    }

    public function profile( $val )
    {
         $this->loginResponse = $this->login();

        try {
            $req = json_decode($this->httpClient->request('GET', 'subscribers/'. $val .'/profile', [
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ] ])->getBody());
            loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'.$val.'/profile', [$req]);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'subscribers/'.$val.'/profile', [ parse_exception( $e ) ]);
            $error = json_encode([ 'error' => parse_exception( $e ) ]);
            return json_decode($error);
        }

        return $req;

    }

    public function offert()
    {
        $this->loginResponse = $this->login();

        try {
            $req = json_decode($this->httpClient->request('GET', 'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
            ])->getBody(), true);
            /*loginfo('offert - user '.app('auth')->user()->name.' response '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [$req]);*/
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error '.config('conf.url_360').'mvno/'.app('session')->get('choose_mvno')->partnerId.'/offers', [ parse_exception( $e ) ]);
            $error = json_encode([ 'error' => parse_exception( $e ) ]);
            return json_decode($error);
        }
        $offerts=null;
        foreach ($req['dataOfferings'] as $value) {
            $find = strpos($value['productName'], 'Default');
            if ( $find === false )
                $offerts[ $value['offeringId'] ] = $value;
        }


        return $offerts;
    }

    public function historysim( $datestart = false,  $datefinish = false, $id = false )
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordSimCards', $currentPage = 1 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return json_encode(json_decode($firstPage));
            }
            $results   = collect( json_decode($firstPage)->dataSim->simCards );

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataSim->totalCount / 50 ) ) ) {
                $results = $results->merge( collect( json_decode($this->retrivepage( 'recordSimCards', ++$currentPage ) )->dataSim->simCards ) );
            }
        } catch (\Exception $e) {
            loginfo($e);
            loginfo('user '.app('auth')->user()->name.' error en recordSimCards', [ parse_exception( $e ) ]);
            $results = collect();
        }

        return $results;
    }

    public function historyoffert( $datestart = false,  $datefinish = false, $id = false )
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordOfferings', $currentPage = 1 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return json_encode(json_decode($firstPage));
            }
            $results   = collect( json_decode($firstPage)->offerings );

            while ( $currentPage <= intval( floor( json_decode($firstPage)->totalCount / 50 ) ) ) {
                $results = $results->merge( collect( json_decode($this->retrivepage( 'recordOfferings', ++$currentPage ) )->offerings ) );
            }
            loginfo($results);
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en recordOfferings', [ parse_exception( $e ) ]);
            $results = collect();
        }

        return $results;
    }

    public function historyconsumo( $datestart = false,  $datefinish = false, $id = false )
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordConsumptions', $currentPage = 1, 2000 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return json_encode(json_decode($firstPage));
            }
            $results   = collect( json_decode($firstPage)->dataConsumption->consumptions );

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataConsumption->totalCount / 2000 ) ) ) {
                $results = $results->merge( collect( json_decode($this->retrivepage( 'recordConsumptions', ++$currentPage, 2000 ) )->dataConsumption->consumptions ) );
            }
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en recordConsumptions', [ parse_exception( $e ) ]);
            $results = collect();
        }


        return $results;
    }

    public function historystatus( $datestart = false,  $datefinish = false, $id = false )
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordStatus', $currentPage = 1 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return json_encode(json_decode($firstPage));
            }
            $results   = collect( json_decode($firstPage)->dataStates->states );

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataStates->totalCount / 50 ) ) ) {
                $results = $results->merge( collect( json_decode($this->retrivepage( 'recordStatus', ++$currentPage ) )->dataStates->states ) );
            }
        } catch (\Exception $e) {
            loginfo($e);
            loginfo('user '.app('auth')->user()->name.' error en recordStatus', [ parse_exception( $e ) ]);
            $results = collect();
        }
        return $results;
    }

    public function historyoperations()
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordOperations', $currentPage = 1, 2000 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return $firstPage;
            }
            $results   = collect(json_decode($firstPage)->dataOperation->operations);

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataOperation->totalCount / 2000 ) ) ) {
                $results = $results->merge(collect(json_decode($this->retrivepage( 'recordOperations', ++$currentPage, 2000 ))->dataOperation->operations ) );
            }
        } catch (\Exception $e) {
            loginfo('Exception...');
            loginfo($e);
            loginfo('user '.app('auth')->user()->name.' error en recordOperations', [ parse_exception( $e ) ]);
            $results = collect();
        }

        return $results;
    }

    public function historyequipo( $imei)
    {
        $this->loginResponse = $this->login();
        return json_decode($this->httpClient->request('GET', 'subscribers/getDeviceInformation', [
                //'query' => ['imei' => $imei ],
                'query' => ['identifierType' => 'imei',
                                 'identifierValue' => $imei ],
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
            ])->getBody());
    }

    public function historyequipow()
    {
        //$msisdn = request()->value;
        $imei = request()->imei;
        $this->loginResponse = $this->login();
        try {
            $req    = json_decode($this->httpClient->request('GET', 'subscribers/getDeviceInformation', [
                    //'query' => ['imei' => $imei ],
                    'query' => ['identifierType' => 'imei',
                                 'identifierValue' => $imei ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                ])->getBody());
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en deviceInformation', [ parse_exception( $e ) ]);
            $req = [];
        }
        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/getDeviceInformation', [$req]);
        return json_encode( $req );
    }

    public function historymovilidad($msisdnToSearch=false)
    {
        $this->loginResponse = $this->login();

        if( ($msisdnToSearch!=false) && (strlen(request()->value) >10 ) ){
             loginfo('al parametro de la consulta de movilidad se asigna valorde msisdnToSearch::' .$msisdnToSearch);
             request()->value=$msisdnToSearch;
        }


        try {
            $firstPage = $this->retrivepage( 'recordActionsByMobility', $currentPage = 1 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return $firstPage;
            }
            $results   = collect( json_decode($firstPage)->dataSuspends->suspends);
            $results2  = collect( json_decode($firstPage)->dataResumes->resumes);

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataSuspends->totalCount / 100 ) ) ) {
                $a = json_decode($this->retrivepage( 'recordActionsByMobility', ++$currentPage ) );
                $results  = $results->merge(collect($a->dataSuspends->suspends ) );
                $results2 = $results->merge(collect($a->dataResumes->resumes ) );
            }

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en recordActionsByMobility'.$e );
            $results = collect();
            $results2 = collect();
        }


        return collect( [$results, $results2] );
    }

    public function historyequipos()
    {
        $this->loginResponse = $this->login();

        try {
            $firstPage = $this->retrivepage( 'recordImeis', $currentPage = 1 );
            if ( isset(json_decode($firstPage)->errorCode) ) {
                return $firstPage;
            }
            $results   = collect( json_decode($firstPage)->dataImei->imeis);

            while ( $currentPage <= intval( floor( json_decode($firstPage)->dataImei->totalCount / 50 ) ) ) {
                $results = $results->merge(collect( json_decode($this->retrivepage( 'recordImeis', ++$currentPage ) )->dataImei->imeis ) );
            }

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error en recordImeis', [ parse_exception( $e ) ]);
            $results = collect();
        }


        return $results;
    }

    public function perfil($msisdn=false)
    {
        $msisdnToSearch = "";
        if (!$msisdn){
            $msisdnToSearch = request()->value;
        }else{
            $msisdnToSearch = $msisdn;
        }
        $this->loginResponse = $this->login();

        $req = json_decode($this->httpClient->request('GET', 'subscribers/'. $msisdnToSearch .'/profileHss', [
                        'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                    ])->getBody());
        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. $msisdnToSearch .'/profileHss', [$req]);
        return json_encode($req);
    }

    public function getKpisTs($imsi)
    {
        $this->loginResponse = $this->login();

        $req = json_decode($this->httpClient->request('GET', 'imsi/'. $imsi .'/kpisTs', [
                        'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                    ])->getBody());
        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'imsi/'. $imsi .'/kpisTs', [$req]);
        return $req;
    }

    public function lastCoverage( $msisdn )
    {
        $this->loginResponse = $this->login();

        $req = json_decode($this->httpClient->request('GET', 'subscribers/'. $msisdn .'/lastCoverage', [
                        'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                    ])->getBody());
        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. $msisdn .'/lastCoverage', [$req]);
        return $req;
    }

    public function validateApn( $msisdn )
    {
        $this->loginResponse = $this->login();
        loginfo('apn-msisdn::'. $msisdn );

        $req = json_decode($this->httpClient->request('POST', 'subscribers/validateApnByClient', [
                    'json' => [ 'msisdn' => $msisdn ],
                    'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ]
                    ])->getBody());
        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/validateApnByClient', [$req]);
        return $req;
    }

    function retrivepage( $path, int $page = 1, int $limit = 50 )
    {
        $params['page']       = $page;
        $params['limit']      = $limit;
        $params['reportMode'] = 'true';

        $response = NULL;

        if( isset( request()->ini ) )
            $params['startDate'] = Carbon::parse( request()->ini )->startOfDay()->format('YmdH');

        if( isset( request()->fin ) ){
            $date = Carbon::parse( request()->fin );
            $now  = Carbon::now()->tz('America/Mexico_City');
            $params['endDate'] = ( $date->format('Ymd') === $now->format('Ymd') )? $now->format('YmdH') : $date->endOfDay()->format('YmdH');
        }

        if ( !isset( request()->ini ) and !isset( request()->fin )){
            $endDate = Carbon::now()->tz('America/Mexico_City')->format('YmdH');

            if (strcmp($path, 'recordActionsByMobility')==0){
                $startDate = Carbon::now()->sub(new DateInterval('P7D'))->tz('America/Mexico_City')->format('YmdH');
                $params['limit'] =100;
                loginfo('StartDate movilidad: '.$startDate);
                loginfo('EndDate movilidad: '.$endDate);

            }else{
                $startDate = Carbon::now()->sub(new DateInterval('P7D'))->tz('America/Mexico_City')->format('YmdH');
            }

            $params['startDate'] = $startDate;
            $params['endDate'] = $endDate;
        }

        loginfo('startDate::'.$params['startDate'] );
        loginfo('endDate  ::'.$params['endDate'] );
        try{
            loginfo('Lanzando la petición hacia...'.'subscribers/'. request()->value .'/'.$path);
            $response = $this->httpClient->request('GET', 'subscribers/'. request()->value .'/'.$path, [
                'query' => $params,
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ],
                'connect_timeout' => 120
            ]);
            loginfo('Datos obtenidos...');
        }catch(BadResponseException $exception){
            loginfo('Fail with http code: '.$exception->getResponse()->getStatusCode());
            $response = $exception->getResponse();
            loginfo('user '.app('auth')->user()->name.' response '.'https://altanredes-test.apigee.net'.$path, [$response->getBody()]);
        }catch(\Exception $excGeneral){
            loginfo('Exception: ');
            loginfo($excGeneral);
        }

        //loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. request()->value .'/'.$path, [ $req ]);

        return $response->getBody();
    }

    function retrivelocal( $value, $path, int $page = 1, int $limit = 50 )
    {
        $params['page']       = $page;
        $params['limit']      = $limit;
        $params['reportMode'] = 'false';

        if( isset( request()->ini ) )
            $params['startDate'] = Carbon::parse( request()->ini )->startOfDay()->format('YmdH');

        if( isset( request()->fin ) ){
            $date = Carbon::parse( request()->fin );
            $now  = Carbon::now()->tz('America/Mexico_City');
            $params['endDate'] = ($date->isToday() or $date->greaterThan($now))? $now->subMinutes(180)->format('YmdH') : $date->endOfDay()->format('YmdH');
        }

        $req = json_decode($this->httpClient->request('GET', 'subscribers/'. $value .'/'.$path, [
                'query' => $params,
                'headers' => [ 'Authorization' => sprintf('Bearer %s', $this->loginResponse->accessToken) ],
                'connect_timeout' => 15
            ])->getBody());

        loginfo('user '.app('auth')->user()->name.' response '.config('conf.url_360').'subscribers/'. $value .'/'.$path, [ $req ]);

        return  $req;
    }

    function setIsRenewable($offerings, $mvno_offerings){
        //todo lo que sea por movilidad no mostrar acciones por movilidad
        foreach ( $offerings as $value) {
            try {
                if ( isset($mvno_offerings[$value->offeringId]['renewal'])  and $mvno_offerings[$value->offeringId]['renewal'] != '') {
                    if($mvno_offerings[$value->offeringId]['renewal'] =='Y'){
                        return "SI";
                    }
                    if($mvno_offerings[$value->offeringId]['renewal'] =='N'){
                        return "NO";
                    }
                }
            } catch (\Exception $e) {

            }
        }
        return "N/A";
    }


}
