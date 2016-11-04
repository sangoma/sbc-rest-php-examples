<?php
/*
 * update package list 
*/

include_once 'setting.inc.php';      
require_once PEST_PATH . 'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'install';
$module_name = 'update';
$obj_type = 'package';
$obj_name = '';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

if ($argc < 2) {
    print "$argv[0] <nsc upgrade package name>\n\n";
	print "Error: Please specify package name from: ./update_package_list.php  command\n";
    exit(1);
}

$data = json_encode(array('name'=>$argv[1]));
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

get obj successful
{
	"status": true,
	"method": "list",
	"module": "update",
	"type": "package",
	"count": 1,
	"data": ["kent-nsc-9.9_.-9-0-dev_.update_.tgz"]
}Status: 200
 *
 * */
?>
