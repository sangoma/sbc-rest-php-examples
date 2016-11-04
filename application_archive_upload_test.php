<?php
/*
 * application archive upload
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
$obj_type = 'archive';
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
    
    $source_file = '/tmp/kent_nsc_dev-backup-test-1.tgz';
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

URL : http://10.10.2.132/SAFe/sng_rest/api/upload/application/archive/ 
result : array ( 
'url' => 'http://10.10.2.132/SAFe/sng_rest/api/upload/application/archive/', 
'content_type' => 'application/json', 
'http_code' => 200, 
'header_size' => 389, 
'request_size' => 270, 
'filetime' => -1, 
'ssl_verify_result' => 0, 
'redirect_count' => 0, 
'total_time' => 0.235159, 
'namelookup_time' => 0.000158, 
'connect_time' => 0.00031, 
'pretransfer_time' => 0.004332, 
'size_upload' => 1250733, 
'size_download' => 73, 
'speed_download' => 310, 'speed_upload' => 5318669, 'download_content_length' => 73, 'upload_content_length' => -1, 
'starttransfer_time' => 0.214881, 'redirect_time' => 0, ) 

Output : {"status":true,"method":"upload","module":"application","type":"archive"} Status : 200
 *
 * */
?>