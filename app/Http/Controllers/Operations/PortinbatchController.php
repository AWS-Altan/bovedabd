<?php

namespace App\Http\Controllers\Operations;

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

class PortinbatchController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,GetMenu;

    /**
     * Show the Porta In.
     *
     * @return view
     */
    public function index()
    {
        $menu = $this->get_menu();
        if ( isset( $menu[51] ) )
            return redirect()->route('home.index');

        return view('operation.portinbatch', ['menu' => $menu] );
    }

       protected function login()
    {

    }


    protected function downloadFile($src){

        if (is_file($src)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $content_type = finfo_file($finfo, $src);
            finfo_close($finfo);
            $file_name = basename($src).PHP_EOL;
            $size = filesize($src);
            header("Content_Type",$content_type);
            header("Content-Disposition: attachment; filename=$file_name");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $size");
            readfile($src);
            return true;
        }else{
            loginfo("case false");
            return false;
        }

    }

    public function download()
    {
        loginfo('Entra a descarga de archivo');
        //loginfo("app_path::". app_path() );


        $file = json_decode( $template->archivo )[0]->download_link;

        loginfo('$file'.$file);

        if ( !$this->downloadFile( app_path().$file  ) ){
             return redirect()->back();
        }


    }

    public function validateFile(){
        $exp_reg='/^[1-9]([0-9]{9})\|\|[1-9]([0-9]{9})\|\|\|\|\|\|Y$/';

        $path = request()->path;
        $file = request()->file('file');

        $archivo=fopen($file, 'r');
        loginfo( 'Inicio lineas archivo');
        $numlinea=0;

        $error=null;
        if ( filesize($file)>0){
            while ($texto = fgets($archivo)) {
                //loginfo( $texto);

                $linea=str_replace( array("\r\n", "\n", "\r"), '', $texto);

                //loginfo('largo::'. strlen($linea) );
                $padLinea=str_pad(($numlinea+1), 3, "000", STR_PAD_LEFT);

                if(strlen($linea)>0){

                    if ( ( strlen($linea) )!=29){
                        $error['longitud'][] = 'l&iacute;nea-'.$padLinea. ' tiene una logitud '. strlen($linea) .' difrente a 29 caracteres';


                    }else{

                        preg_match( $exp_reg ,$linea,$coincidencias );

                             if ( count( $coincidencias)<=0){
                                $error['patron'][] = 'linea-'.$padLinea. ' no cumple con el formato';
                             }
                    }
                }

                $numlinea++;
                if ($numlinea>1000) break;
            }
            fclose($archivo);
            loginfo( 'Fin lineas archivo, total de lineas:' . $numlinea );


            if ($numlinea>1000){
                $error['total de renglones'][] = 'El archivo tiene más de 1000 líneas';
                return json_encode([
                    'error'       =>  $error,
                    'statusCode'  => '400'
                ]);
            }
            elseif ( !is_null($error) && count( $error ) >0 ) {
                return json_encode([
                    'error' => $error,
                    'statusCode' => '400'
                ]);
            }
        }
        else{

            $error['patron'][] = 'No es posible cargar el archivo seleccionado debido a que está vacío';
            return json_encode([
                    'error' => $error,
                    'statusCode' => '400'
                ]);
        }


        return json_encode([ 'validacionFile' => 'OK',
                'statusCode' => '200'
            ]);
    }



}
