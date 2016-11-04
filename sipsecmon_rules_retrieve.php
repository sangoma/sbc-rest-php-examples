<?php
/*
 * sip profile create 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'sipsecmon';
$obj_type = 'rules';
$obj_name = 'test';

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
 {
	"status": true,
	"method": "retrieve",
	"module": "sipsecmon",
	"type": "rules",
	"name": "test",
	"data": {
		"failed_attempts": "2",
		"time_frame": "2",
		"src_ip_filter_expr": "",
		"profile_filter": "",
		"account_filter_expr": "",
		"user_agent_filter_expr": "",
		"action_expr": "false",
		"action_param": "",
		"comments": ""
	}
}
Status: 200


 *
 * */
?>