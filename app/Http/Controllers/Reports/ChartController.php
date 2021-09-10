<?php
namespace App\Http\Controllers\Reports;
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
use Charts;
use App\User;
use DB;



class ChartController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests,GetMenu;

    public function __construct()
    {
        $this->httpClient   = new Client( [ 'base_uri' => config('conf.url_report_graps') ] );
    }



    public function index()
    {

        $menu = $this->get_menu();
        if ( isset( $menu[16] ) )
            return redirect()->route('home.index');
        // Get users grouped by age
        $groups = DB::table('tbl_ctl_monitoring_user_admin')
                    ->select('operacion', DB::raw('count(*) as total'))
                    ->groupBy('operacion')
                    ->pluck('total', 'operacion')->all();
        // Generate random colours for the groups
        for ($i=0; $i<=count($groups); $i++) {
                $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            }
        // Prepare the data for returning with the view
        $cJL_chart = new Charts;
            $cJL_chart->labels = (array_keys($groups));
            $cJL_chart->dataset = (array_values($groups));
            $cJL_chart->colours = $colours;
            //return view('charts.index', compact('chart'));
            //return view('reports.chart')-> with('menu',$menu);
            return view('reports.chart', compact('cJL_chart'))-> with('menu',$menu);
    }


    public function FunRepMonitorAdminUsers()
    {
        //$this->loginResponse = $this->login();

        loginfo('Obtiene Datos del API para el reporte: ');

        $json = request()->json()->all();
        loginfo($json);


        try {
            $req = json_decode($this->httpClient->request('POST',config('conf.url_report_graps'). 'monitor_admin_users'
                , [
                    'json' => $json,
                  ])->getBody());

            loginfo('user ' . app('auth')->user()->name . ' response ' . config('conf.url_report_graps') . 'monitor_admin_users', [$req]);
            loginfo('termina ejecución API');
        } catch (\Exception $e) {
            loginfo('user '.app('auth')->user()->name.' error ' . config('conf.url_report_graps') .'monitor_admin_users', [ $e ]);


        }
        loginfo('Regreso información');
        return json_encode( $req );

    }//FunRepMonitorAdminUsers

}
