<?php

namespace App\Http\Controllers\Reports;

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

class GeneralActivityReportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client( [ 'base_uri' => config('conf.url_activities_report') ] );

    }


    /**
     * Show the Porta In.
     *
     * @return view
     */
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[16] ) )
            return redirect()->route('home.index');

        return view('reports.general-activity')-> with('menu',$menu);
    }

    
    public function getList()
    {
        
        loginfo('Obtiene reorte de actividades');

        $json = request()->json()->all();
        loginfo($json);


        try {

            $req = json_decode($this->httpClient->request('POST',config('conf.url_activities_report'). 'report'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_activities_report') . 'report', [$req]);

        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_activities_report') .'report'
                , [ parse_exception( $e ) ]);


        }

        return json_encode( $req );
    }




}
