<?php
/*
 *sip trunk delete 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'delete';
$module_name = 'sip';
$obj_type = 'trunk';
$obj_name = 'Nsc_SIP_trunk8';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

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
deleted successful 
 {
	"status": true, 
	"method": "delete",
	"module": "sip",
	"type": "trunk",
	"name": "Nsc_SIP_trunk7"
} 
Status : 200

obj not found 
{
	"status": false,
	"error": "Not Found",
	"method": "delete",
	"module": "sip",
	"type": "trunk",
	"name": "NSC_New_Sip_trunk9"
}
Status: 404
 */

?>