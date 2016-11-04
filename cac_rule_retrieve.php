<?php
/*
 * cac rule retrieve 
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

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;


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
	"data": {
		"sip-profiles": ["NSC_SIP_Profile1"]
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
	"name": "CAC_Profile11"
}
Status: 404
 *
 * */
?>