<?php
/*
 * sngms configuration update 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'shutdown';
$module_name = 'system';
$obj_type = 'reboot/mode';
$obj_name = '';

#/SAFe/sng_rest/api/fwupdate/sngms/sngdsp0 
#$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;
$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type;

$data = json_encode(array('mode'=>'reboot'));
#$data = json_encode({'mode'=>'reboot'});

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
{
	"status": true,
	"method": "update",
	"module": "sngms",
	"type": "configuration"
}Status: 200

{
	"status": false,
	"error": {
		"interfaces[]": "The Detect Media Interfaces field is required."
	},
	"method": "update",
	"module": "sngms",
	"type": "configuration"
}Status: 400
 */
?>
