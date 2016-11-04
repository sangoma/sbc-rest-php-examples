<?php
/*
 * cac rule user retrieve 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'cac';
$obj_type = 'rule';
$obj_name = 'CAC_Profile1';
$sub_obj_type = 'user';
$sub_obj_name = 'Rule2';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name .'/'. $sub_obj_type .'/'. $sub_obj_name;


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
    $data  = null;
    
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
	"module": "cac",
	"type": "rule",
	"name": "CAC_Profile1",
	"child_type": "user",
	"child_name": "Rule2",
	"data": {
		"sip_auth_username": "bob@test.com",
		"max": "1",
		"rate1": "1",
		"rate2": "3"
	}
}
Status: 200

Obj not found
{
	"status": false,
	"error": "Not Found",
	"method": "retrieve",
	"module": "cac",
	"type": "rule",
	"name": "CAC_Profile1",
	"child_type": "user",
	"child_name": "Rule11"
}
Status: 404
 *
 * */
?>