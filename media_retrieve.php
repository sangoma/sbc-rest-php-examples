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
$module_name = 'media';
$obj_type = 'profile';
$obj_name = 'NSC_New_Media_Profile2';

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
	"module": "media",
	"type": "profile",
	"name": "NSC_New_Media_Profile2",
	"data": {
		"codec-1": "PCMU@20i",
		"codec-2": "PCMA@20i",
		"codec-3": "PCMU@30i",
		"codec-4": "PCMA@30i",
		"codec-5": "none",
		"negotiation": "generous",
		"silence-supp": "false",
		"dtmf-type": "rfc2833"
	}
}
Status: 200

Obj not found
{
	"status": false,
	"error": "Not Found",
	"method": "retrieve",
	"module": "media",
	"type": "profile",
	"name": "NSC_New_Media_Profile33"
}
Status: 404
 *
 * */
?>