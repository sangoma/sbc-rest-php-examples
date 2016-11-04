<?php
/*
 * application version retrieve 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'application';
$obj_type = 'version';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type;


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
    $pest = new PestJSON($base_url);
    
    $status = $pest->get($request_uri, $data, $header_array);
} catch(Exception $e) {
    $status = json_decode($e->getMessage(), true);
}

$rc = $pest->lastStatus();
print('URL      : ' . $base_url.$request_uri.PHP_EOL);
print('Output   : ' . json_encode($status) .PHP_EOL);
print('Status   : ' . $rc.PHP_EOL);

/*
 * Output sample
{
	"status": true,
	"method": "retrieve",
	"module": "application",
	"type": "version",
	"data": {
		"build_version": "85",
		"full_name": "NetBorder Session Controller",
		"major_version": "9",
		"minor_version": "9",
		"name": "nsc",
		"patch_version": "9",
		"product_version": "9.9.9-85",
		"release_version": "dev",
		"short_name": "nsc"
	}
}Status: 200

 *
 * */
?>