<?php
/*
 * application log download
 */
include_once 'setting.inc.php';
require_once PEST_PATH . 'pest/PestJSON.php';

$options ['server'] = 'http://' . SERVER;
$options ['request'] = 'GET';

$base_url = $options ['server'] . '/SAFe/sng_rest/api/';
$method_name = 'download';
$module_name = 'application';
$obj_type = 'log';
$obj_name = 'nsc.log.17';

$request_uri = $method_name . '/' . $module_name . '/' . $obj_type . '/' . $obj_name;

try {
    // API_KEY defined in 'setting.inc.php' send api key in header
    if (defined ( 'API_KEY' )) {
        $header = "API_KEY:" . API_KEY . "\r\n" . "Content-Type: application/json";
    } else {
        $header = "Content-Type: application/json\r\n";
    }
    
    $opts = array (
            'http' => array (
                    'method' => 'GET',
                    'header' => "Content-type: application/json\r\n" . "X-API-KEY:" . API_KEY 
            ) 
    );
    $context = stream_context_get_default ( $opts );
    $body = fopen ( $base_url . $request_uri, 'r', false, $context );
    $http_response_code = substr($http_response_header[0], 9, 3);
    var_dump($http_response_code);
    if($http_response_code == '200'){
        $response_header = array ();
        foreach ( $http_response_header as $header_item ) {
            if (strpos ( $header_item, ':' ) !== false) {
                list ( $name, $value ) = split ( ':', $header_item, 2 );
                $response_header [$name] = trim ( $value );
            }
        }
        // ["Content-Disposition"]=> string(63) "attachment;
        // filename="kent_nsc_dev-log-2013-06-28-16-31-25.zip""
        if (isset ( $response_header ['Content-Disposition'] )) {
        $filename = str_replace ( '"', '', end ( split ( '=', $response_header ['Content-Disposition'] ) ) );
        }
        $rs = file_put_contents ( "/tmp/" . $filename, $body );
        $msg = 'file size = '.$rs;
    }else{
        $msg = $http_response_header[0];
    }
    fclose ( $body );
   
} catch ( Exception $e ) {
    $status = json_decode ( $e->getMessage (), true );
}

// print('$header : ' . $header.PHP_EOL);
print ('URL      : ' . $base_url . $request_uri . PHP_EOL) ;
print ('result   : ' . $msg . PHP_EOL) ;

/*
 * Output sample
URL : http://10.10.2.132/SAFe/sng_rest/api/download/application/log/nsc.log.10 
copy : 10485777

 *
 * */
?>