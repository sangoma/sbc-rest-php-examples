<?php
/*
 *sip trunk retrieve 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'sip';
$obj_type = 'trunk';
$obj_name = 'Nsc_SIP_trunk8';

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
* get obj successful
{
	"status": true,
	"method": "retrieve",
	"module": "sip",
	"type": "trunk",
	"name": "Nsc_SIP_trunk1",
	"data": {
		"realm": "rwar",
		"username": "root",
		"password": "sangoma",
		"from-user": "",
		"from-domain": "",
		"caller-id-in-from": "true",
		"register-transport": "udp",
		"proxy": "",
		"outbound-proxy": "",
		"register": "false",
		"register-proxy": "",
		"distinct-to": "false",
		"expire-seconds": 3600,
		"retry-seconds": 30,
		"timeout-seconds": 60,
		"contact-host": "",
		"contact-params": "",
		"ping": "",
		"ping-max": "",
		"ping-min": "",
		"sip_profile": "NSC_SIP_Profile1",
		"inbound-media-profile": "",
		"outbound-media-profile": "",
		"call-routing": "default",
		"max-sessions": "",
		"session-rate-limit": "",
		"session-rate-period": "",
		"carrier_name": "none"
	}
}
Status: 200

Obj not found
{
	"status": false,
	"error": "Not Found",
	"method": "retrieve",
	"module": "sip",
	"type": "trunk",
	"name": "Nsc_SIP_trunk122"
}
Status: 404
*/
?>