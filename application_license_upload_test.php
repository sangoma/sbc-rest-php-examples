<?php
/*
 * application license upload
 */
define("PEST_PATH", "../../packaging/tools/scripts/php/");
define("API_KEY","4F8E4416F367476102834B7AA1F76574");
define("SERVER","10.10.2.105");
require_once PEST_PATH . 'pest/PestJSON.php';

$options ['server'] = 'http://' . SERVER;
$options ['request'] = 'GET';

$base_url = $options ['server'] . '/SAFe/sng_rest/api/';
$method_name = 'upload';
$module_name = 'application';
$obj_type = 'license';
$obj_name = '';

$request_uri = $method_name . '/' . $module_name . '/' . $obj_type . '/' . $obj_name;

try {
    // API_KEY defined in 'setting.inc.php' send api key in header
    if (defined ( 'API_KEY' )) {
        $header = "X-API-KEY:" . API_KEY . "\r\n" . "Content-Type: application/json";
    } else {
        $header = "Content-Type: application/json";
    }
    
    $ch = curl_init();
    
    $source_file = '/tmp/nsc-license.tgz';
    $upload_file_name = "UPLOAD_FILE_NAME:" . basename($source_file);
    $upload_url = $base_url . $request_uri;
    
    // Open the sourcefile
    $readfile = fopen($source_file, 'rb');
    
    curl_setopt($ch, CURLOPT_URL, $upload_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_PUT, true);
    
    curl_setopt($ch, CURLOPT_INFILE, $readfile);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($header){
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header , $upload_file_name));
    }
        
    // Relay the file to http://example.com/
    $response = curl_exec($ch);
    
    // Close the source file
    fclose($readfile);
    
    $info = curl_getinfo($ch);
    // close cURL resource, and free up system resources
    curl_close($ch);
        
   
} catch ( Exception $e ) {
    $status = json_decode ( $e->getMessage (), true );
}

print ('URL      : ' . $base_url . $request_uri . PHP_EOL) ;
print ('result   : ' . var_export($info, true) . PHP_EOL) ;

print('Output   : ' . $response .PHP_EOL);
print('Status   : ' . $info['http_code'].PHP_EOL);

/*
 * Output sample
 * 
 * 

http://10.10.2.132/SAFe/sng_rest/api/download/application/license/kent_nsc_dev-backup-2013-07-03-12-40-29.tgz 
result : file size = 1250112

http://10.10.2.132/SAFe/sng_rest/api/download/application/license/nsc.license.17 
result : HTTP/1.0 404 Not Found
 *
 * */
?>