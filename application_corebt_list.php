<?php
/*
 * application corebt list 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'list';
$module_name = 'application';
$obj_type = 'corebt';
$obj_name = '';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;


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
	"method": "list",
	"module": "application",
	"type": "corebt",
	"count": 4,
	"data": ["core.nsc.11.13991.1364326246.bt",
	"core.nsc.11.1406.1364266872.bt",
	"core.nsc.11.2302.1361402652.bt",
	"core.nsc.11.2312.1361466691.bt"]
}Status: 200

 *
 * */
?>