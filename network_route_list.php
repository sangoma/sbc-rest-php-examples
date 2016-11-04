<?php
/*
 * sip profile create 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'list';
$module_name = 'network';
$obj_type = 'route';
$obj_name = '';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

$data = null;
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
	"method": "list",
	"module": "network",
	"type": "route",
	"count": 4,
	"data": ["192.168.2.1",
	"192.168.3.1",
	"192.168.4.1",
	"192.168.5.1"]
}
Status: 200


 *
 * */
?>