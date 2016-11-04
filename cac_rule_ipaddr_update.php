<?php
/*
 * cac rule ipaddr update 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'update';
$module_name = 'cac';
$obj_type = 'rule';
$obj_name = 'CAC_Profile4';
$sub_obj_type = 'ipaddr';
$sub_obj_name = 'Rule13';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name .'/'. $sub_obj_type .'/'. $sub_obj_name;


$json_data ='
{
		"sip_received_ip": "10.99.10.10",
		"max": "1",
		"rate1": "1",
		"rate2": "1"
	}';
$data = json_decode($json_data);

try {
    //API_KEY defined in 'setting.inc.php' send api key in header
    //$header_array[]="X-API-KEY:C2FF69E5B86551C8062F9B56E1065370"
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
Update obj successful
{
	"status": true,
	"method": "update",
	"module": "cac",
	"type": "rule",
	"name": "CAC_Profile1",
	"child_type": "ipaddr",
	"child_name": "Rule1"
}
Status: 200

Obj not found
{
	"status": false,
	"error": "Not Found",
	"method": "update",
	"module": "cac",
	"type": "rule",
	"name": "CAC_Profile1",
	"child_type": "ipaddr",
	"child_name": "Rule12"
}
Status: 404


data error
{
	"status": false,
	"error": {
		"sip_received_ip": "The IP Address field is required."
	},
	"method": "update",
	"module": "cac",
	"type": "rule",
	"name": "CAC_Profile1",
	"child_type": "ipaddr",
	"child_name": "Rule1"
}
Status: 400
 */
?>