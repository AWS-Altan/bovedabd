<?php 

if (!function_exists('request')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function request()
    {
        return app('request');
    }
}

if (! function_exists('loginfo') ) 
{
    /**
     * write in log 
     * 
     * @param  string $message [description]
     * @param  array  $context [description]
     */
    function loginfo( $message = 'fail', $context = [] )
    {
        try {
            Log::channel('custom')->info( $message, $context );
        } catch (\Exception $e) {
            Log::channel('error')->error( $e->getMessage() );
        }
        
    }
}

if (!function_exists('parser_date')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function parser_date( $date )
    {
        return \Carbon\Carbon::parse($date)->format('Y-m-d H:i');
    }
}

if (!function_exists('convertToReadableSize')) {
    function convertToReadableSize($size){
        try {
            $base = log($size) / log(1024);
            $suffix = array("", "KB", "MB", "GB", "TB");
            $f_base = floor($base);
            $resp = round(pow(1024, $base - floor($base)), 1);
            if(is_nan($resp)){
                return 0 . $suffix[$f_base];
            }else{
                return $resp . $suffix[$f_base];
            }
        } catch (\Exception $e) {
            Log::channel('error')->error( $e );
            return $size;
        }
        
    }
}

if (!function_exists('convert_bytes')) {
    function convert_bytes($bytes, $to, $decimal_places = 0) {
        $formulas = array(
            'K' => number_format($bytes / 1024, $decimal_places),
            'M' => number_format($bytes / 1048576, $decimal_places),
            'G' => number_format($bytes / 1073741824, $decimal_places)
        );
        return isset($formulas[$to]) ? $formulas[$to] : 0;
    }
}

if (!function_exists('parse_exception')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function parse_exception( $e )
    {
    	if ( $e->hasResponse() ) {
            try {
                $val    = \GuzzleHttp\Psr7\str($e->getResponse());
                $val    = explode('{', $val);
                $val    = explode('"description":', $val[1]);
                $string = str_replace(' ', '-', $val[1]); 
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
                $string = str_replace('-', ' ', $string);
                if (strlen($val[0]) >=1){
                    $val0   = preg_replace('/[^A-Za-z0-9\-]/', ' ', $val[0]); 
                    $string = $val0 .' '. $string; 
                }
                return $string;
            } catch (\Exception $ee) {
                return $e->getMessage();
            }
            
        }
        
        return 'error';
    }
}

if (!function_exists('hora')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function hora($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('H:i');
        } catch (\Exception $e) {
            //dd($e->getMessage());
            return $date;
        }
        
    }
}

if (!function_exists('fecha')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function fecha($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            $dateTime = DateTime::createFromFormat('Ymd H', $date);
            return $date;
        }
    }
}

if (!function_exists('hora1')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function hora1($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('H:i');
        } catch (\Exception $e) {
            //dd($e->getMessage());
            $dateTime = DateTime::createFromFormat('Ymd H', $date);
            return $dateTime->format('H:i');
        }
        
    }
}

if (!function_exists('fecha1')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function fecha1($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            $dateTime = DateTime::createFromFormat('Ymd H', $date);
            return $dateTime->format('Y-m-d');
        }
    }
}

if (!function_exists('hora2')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function hora2($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('H:i');
        } catch (\Exception $e) {
            $dateTime = explode(' ', $date);
            $hora = explode(':', $dateTime[1]);
            return $hora[0].':'.$hora[1];
        }
        
    }
}

if (!function_exists('fecha2')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function fecha2($date)
    {
        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            $dateTime = explode(' ', $date);
            return $dateTime[0];
        }
    }
}

if (!function_exists('cicloindividual')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function cicloindividual( $nombre, $oferta, $fecha )
    {
        $nombreUp = strtoupper($nombre);

        $FIFFlabel = strpos($nombreUp, "FIFF");
        if ($FIFFlabel !== false){
            $diaD = "";

            if(strpos($nombreUp, "2D") !== false){
                $diaD = "2D";
            }
            if(strpos($nombreUp, "7D") !== false){
                $diaD = "7D";
            }
            if(strpos($nombreUp, "14D") !== false){
                $diaD = "14D";
            }
            if(strpos($nombreUp, "30D") !== false){
                $diaD = "30D";
            }
            return "Fecha Inicio - Fecha Fin ". $diaD;
        }

        $FFM = strpos($nombreUp, "FFM");
        if ($FFM !== false){
            $dia = \Carbon\Carbon::parse( $fecha )->format('d');
            return "Fecha Fija Mes: Cada día ".$dia;
        }

        $MTH = strpos($nombreUp, "MTH");
        if ($MTH !== false){
            $dia = \Carbon\Carbon::parse( $fecha )->format('d');
            return "Mes Calendario";
        }

        $SS = strpos($nombreUp, "SS");
        if ($SS !== false){
            $dia = \Carbon\Carbon::parse( $fecha )->format('d');
            return "Depend of Default Supplementary";
        }

        $dos = strpos($nombreUp, "2D");
        if ($dos !== false){
            return "2";
        }

        $siete = strpos($nombreUp, "7D");
        if ($siete !== false){
            return "7";
        }

        $catorce = strpos($nombreUp, "14D");
        if ($catorce !== false){
            return "14";
        }

        $quince = strpos($nombreUp, "15D");
        if ($quince !== false){
            return "15";
        }

        $treinta = strpos($nombreUp, "30D");
        if ($treinta !== false){
            return "30";
        }

        $tethering = strpos($nombreUp, "CY");
        if($tethering !== false){
            $diasT = substr($nombreUp, $tethering + 2, 2);
            return "Fecha Fija Mes Dinámica día ".$diasT;
        }

        return '';
    }
}

if (!function_exists('startsWith')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function startsWith ($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 
}

if (!function_exists('endsWith')) {
    /**
     * Retrieves application request
     *
     * @return Singleton instance
     */
    function endsWith($string, $endString) 
    { 
        $len = strlen($endString); 
        if ($len == 0) { 
            return true; 
        } 
        return (substr($string, -$len) === $endString); 
    } 
}

if (!function_exists('isExpired')) {
    /**
     * Evaluate if the endDate has expired. 
     *
     * @return true  if it is less than today, false in other case
     */
    function isExpired($endDate) 

    { 
        $expirada =  False;
        $now  = \Carbon\Carbon::now();
        $date = \Carbon\Carbon::parse( $endDate );

       if ( $now->gt($date) ) {
        $expirada =  True;
       }
       
        return  $expirada; 
    } 
}