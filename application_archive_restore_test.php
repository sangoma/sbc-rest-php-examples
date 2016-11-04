<?php
/*
 * application archive restore
 */
//include_once 'setting.inc.php';
define("PEST_PATH", "../../packaging/tools/scripts/php/");
define("API_KEY","4F8E4416F367476102834B7AA1F76574");
define("SERVER","10.10.2.105");
require_once PEST_PATH . 'pest/PestJSON.php';

$options ['server'] = 'http://' . SERVER;
$options ['request'] = 'POST';

$base_url = $options ['server'] . '/SAFe/sng_rest/api/';
$method_name = 'restore';
$module_name = 'application';
$obj_type = 'archive';
$obj_name = 'kent-nsc-dev-backup-test-1.tgz';

$request_uri = $method_name . '/' . $module_name . '/' . $obj_type . '/' . $obj_name;

$json_data = '
{
}';
$data = json_decode ( $json_data );
try {
    // API_KEY defined in 'setting.inc.php' send api key in header
    // $header_array[]="X-API-KEY:C2FF69E5B86551C8062F9B56E1065370"
    // $header_array[]="Content-Type: application/json" auto set by PestJSON
    if (defined ( 'API_KEY' )) {
        $header_array [] = 'X-API-KEY:' . API_KEY;
    } else {
        $header_array = null;
    }
    $pest = new PestJSON ( $base_url );
    
    $status = $pest->post ( $request_uri, $data, $header_array );
} catch ( Exception $e ) {
    $status = json_decode ( $e->getMessage (), true );
}

$rc = $pest->lastStatus ();
print ('URL      : ' . $base_url . $request_uri . PHP_EOL) ;
print ('Output   : ' . json_encode ( $status ) . PHP_EOL) ;
print ('Status   : ' . $rc . PHP_EOL) ;

/*
 * Output sample
Output: 
Output: {
	"status": true,
	"method": "restore",
	"module": "application",
	"type": "archive",
	"name": "kent_nsc_dev-backup-2013-07-03-12-40-29.tgz"
}Status: 200


{
	"status": false,
	"error": {
		"notif_error": "Netborder Session Controller is Running"
	},
	"method": "restore",
	"module": "application",
	"type": "archive"
}Status: 400

{
	"status": false,
	"error": {
		"notif_error": "Fail to Restore Archive ."
	},
	"method": "restore",
	"module": "application",
	"type": "archive"
}Status: 400
 *
 * */
?>