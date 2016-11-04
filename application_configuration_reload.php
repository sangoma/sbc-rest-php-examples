<?php
/*
 * application configuration reload 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'reload';
$module_name = 'application';
$obj_type = 'configuration';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type;


$json_data ='
{
}';
$data = json_decode($json_data);
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
    
    $status = $pest->post($request_uri, $data, $header_array);
} catch(Exception $e) {
    $status = json_decode($e->getMessage(), true);
}

$rc = $pest->lastStatus();
print('URL      : ' . $base_url.$request_uri.PHP_EOL);
print('Output   : ' . json_encode($status) .PHP_EOL);
print('Status   : ' . $rc.PHP_EOL);

/*
 * Output sample
reload successful
Output: 
{
	"status": true,
	"method": "reload",
	"module": "application",
	"type": "configuration"
}
Status: 200

reload failed
Output: 
{
	"status": false,
	"error": {
		"sys_running": "System is not Running"
	},
	"method": "reload",
	"module": "application",
	"type": "configuration"
}
Status: 400
 
 {
	"status": true,
	"error": ["Post Write Failed for sipsecmon."],
	"method": "reload",
	"module": "application",
	"type": "configuration"
}Status: 200
 *
 * */
?>