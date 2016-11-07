<?php
/*
 * application configuration status 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'status';
$module_name = 'application';
$obj_type = 'configuration';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type;


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
nothing modified
{
	"status": true,
	"method": "status",
	"module": "application",
	"type": "configuration",
	"data": {
		"modified": false
	}
}
Status: 200

System is running and
some reloadable obj modified
so the configuration can be reload 
{
	"status": true,
	"method": "status",
	"module": "application",
	"type": "configuration",
	"data": {
		"modified": true,
		"can_apply": false,
		"can_reload": true,
		"reloadable": {
			"dialplan": {
				"dialplan": {
					"new_dialplan1": "N"
				}
			}
		}
	}
}Status: 200

System is running and
some not reloadable obj modified like 'RADIUS - VSAs configuration'
so the configuration call not be reload 
{
	"status": true,
	"method": "status",
	"module": "application",
	"type": "configuration",
	"data": {
		"modified": true,
		"can_apply": false,
		"can_reload": false,
		"reloadable": false
	}
}
Status: 200

System is not running and
any obj modified
so the configuration can be apply
{
	"status": true,
	"method": "status",
	"module": "application",
	"type": "configuration",
	"data": {
		"modified": true,
		"can_apply": true,
		"can_reload": false,
		"reloadable": {
			"core": {
				"configuration": "M"
			},
			"sip": {
				"trunk": {
					"application_SIP_trunk2": "M",
					"application_SIP_trunk4": "N",
					"application_SIP_trunk3": "D"
				},
				"profile": {
					"application_SIP_Profile1": "M",
					"application_SIP_Profile7": "N"
				}
			}
		}
	}
}
Status: 200
 *
 * 
 */
?>
