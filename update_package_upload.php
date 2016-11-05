<?php
/*
 * update package status 
*/

include_once 'setting.inc.php';      
require_once PEST_PATH . 'pest/PestJSON.php';

$options['server'] = 'http://'.SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'upload';
$module_name = 'update';
$obj_type = 'package';
$obj_name = '';
$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

if ($argc < 2) {
    print "$argv[0] <path to nsc upgrade package file>\n\n";
    exit(1);
}

$source_file = $argv[1];

if (!file_exists($source_file)) {
	print "Error " . $source_file . " file does not exist\n";
	exit(1);
}

$data = null;
try {
    //API_KEY defined in 'setting.inc.php' send api key in header
    //$header_array[]="X-API-KEY:C2FF69E5B86551C8062F9B56E1065370"
    //$header_array[]="Content-Type: application/json" auto set by PestJSON
    if(defined('API_KEY'))
    {
        $header_array[] = 'X-API-KEY:'.API_KEY;
    }else{
        $header_array = null;
    }

    if (function_exists('curl_file_create')) { // php 5.6+
        $cFile = curl_file_create($source_file);
    } else { //
        $cFile = '@' . realpath($source_file);
    }
    
    $post_data = array('Upload'=>'YES','archive'=>$cFile); //array('Upload' => 'YES', 'archive' => "@".$source_file );
    $ch = curl_init();
    $upload_url = $base_url . $request_uri;
    curl_setopt($ch,CURLOPT_URL,$upload_url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_VERBOSE,true);
    curl_setopt($ch,CURLOPT_HEADER,false);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_TIMEOUT,7200);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
    if($header_array)
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header_array);

    $response = curl_exec($ch);

    $info = curl_getinfo($ch);
    curl_close($ch);
    
} catch(Exception $e) {
    $status = json_decode($e->getMessage(),true);
}

print ('URL      : ' . $base_url . $request_uri . PHP_EOL) ;
print ('result   : ' . var_export($info, true) . PHP_EOL) ;

print('Output   : ' . $response .PHP_EOL);
print('Status   : ' . $info['http_code'].PHP_EOL);

/*
 * Output sample

get obj successful
{
	"status": true,
	"method": "status",
	"module": "update",
	"type": "package",
	"data": ["Not started"]
}Status: 200
 *
 * */
?>
