<?php
/*
 * application archive list 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'list';
$module_name = 'application';
$obj_type = 'archive';
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
	"type": "archive",
	"count": 8,
	"data": ["kent_nsc_dev-backup-2013-04-22-11-52-22.tgz",
	"kent_nsc_dev-backup-2013-04-25-15-06-06.tgz",
	"kent_nsc_dev-backup-2013-05-28-14-16-01.tgz",
	"kent_nsc_dev-backup-2013-06-27-17-36-10.tgz",
	"kent_nsc_dev-backup-2013-07-02-17-19-30.tgz",
	"kent_nsc_dev-backup-2013-07-02-17-23-44.tgz",
	"kent_nsc_dev-backup-2013-07-02-17-27-12.tgz",
	"kent_nsc_dev-backup-2013-07-02-17-27-57.tgz"]
}Status: 200

 *
 * */
?>