<?php
/*
 * media profile retrieve 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'directory';
$obj_type = 'domain';
$obj_name = 'test1.com';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;


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

get obj successful
{
	"status": true,
	"method": "retrieve",
	"module": "directory",
	"type": "domain",
	"name": "test1.com",
	"data": {
		"forward-registration": "false",
		"registrar-profile": "none",
		"registrar-server": "",
		"registrar-port": "5060",
		"register-transport": "udp",
		"sip-force-expires": ""
	}
}Status: 200

Obj not found
{
	"status": false,
	"error": "Not Found",
	"method": "retrieve",
	"module": "directory",
	"type": "domain",
	"name": "test10.com"
}
Status: 404
 *
 * */
?>