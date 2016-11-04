<?php
/*
 * certificate ca update 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'update';
$module_name = 'certificate';
$obj_type = 'ca';
$obj_name = 'yahoo_com.pem';

$sample_file = 'yahoo_com.pem';

$config['allowed_types'] = 'pem';
$config['max_size']  = 1024 * 8;

if(pathinfo($sample_file, PATHINFO_EXTENSION) != $config['allowed_types']){
    die('error file type.');
}
if(filesize($sample_file) > $config['max_size'] ){
    die('file size error.');
}
$content = file_get_contents($sample_file);
$ssl = openssl_x509_parse($content);

if(isset($ssl['issuer'])){
    if(isset($ssl['issuer']['CN']))         $data['issuer'] = $ssl['issuer']['CN'];
}
    
if(isset($ssl['subject'])){
    if(isset($ssl['subject']['CN']))    $data['subject'] = $ssl['subject']['CN'];
}
    
if(isset($ssl['validTo_time_t'])){
    $data['expires'] = date("Y-m-d H:i:s", $ssl['validTo_time_t']);
}

$base64_encode_contents = base64_encode($content);

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

$json_data ='
{
		"certificate-file-contents": "'.$base64_encode_contents.'",
		"certificate-file-name": "'.$sample_file.'"
	}';
$data = json_decode($json_data);
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
	"module": "certificate",
	"type": "ca",
	"name": "yahoo_com.pem"
}Status: 200


 */
?>