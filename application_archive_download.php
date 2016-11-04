<?php
/*
 * application archive download
 */
include_once 'setting.inc.php';
require_once PEST_PATH . 'pest/PestJSON.php';

$options ['server'] = 'http://' . SERVER;
$options ['request'] = 'GET';

$base_url = $options ['server'] . '/SAFe/sng_rest/api/';
$method_name = 'download';
$module_name = 'application';
$obj_type = 'archive';
$obj_name = 'kent_nsc_dev-backup-2013-07-03-12-40-29.tgz';

$request_uri = $method_name . '/' . $module_name . '/' . $obj_type . '/' . $obj_name;

try {
    // API_KEY defined in 'setting.inc.php' send api key in header
    if (defined ( 'API_KEY' )) {
        $header = "X-API-KEY:" . API_KEY . "\r\n" . "Content-Type: application/json";
    } else {
        $header = "Content-Type: application/json";
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
    if($http_response_code == '200'){
        $response_header = array ();
        foreach ( $http_response_header as $header_item ) {
            if (strpos ( $header_item, ':' ) !== false) {
                list ( $name, $value ) = split ( ':', $header_item, 2 );
                $response_header [$name] = trim ( $value );
            }
        }
        // ["Content-Disposition"]=> string(63) "attachment;
        // filename="kent_nsc_dev-archive-2013-06-28-16-31-25.zip""
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
 * 
 * 

http://10.10.2.132/SAFe/sng_rest/api/download/application/archive/kent_nsc_dev-backup-2013-07-03-12-40-29.tgz 
result : file size = 1250112

http://10.10.2.132/SAFe/sng_rest/api/download/application/archive/nsc.archive.17 
result : HTTP/1.0 404 Not Found
 *
 * */
?>