<?php
/*
 * application archive upload
 */
include_once 'setting.inc.php';
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
        $header = "X-API-KEY:" . API_KEY;
    } else {
        $header = '';
    }
    
    $source_file = '/tmp/kent_nsc_dev-backup-test-1.tgz';
    
    // File you want to upload/post
    $post_data = array('Upload' => 'YES', 'archive' => "@".$source_file );
    $upload_url = $base_url . $request_uri;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $upload_url);
    // Pass TRUE or 1 if you want to wait for and catch the response against the request made
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // For Debug mode; shows up any error encountered during the operation
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    // Data+Files to be posted
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    if($header){
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
    }
        
    // Relay the file to http://example.com/
    $response = curl_exec($ch);
    
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

http://10.10.2.132/SAFe/sng_rest/api/download/application/archive/kent_nsc_dev-backup-2013-07-03-12-40-29.tgz 
result : file size = 1250112

http://10.10.2.132/SAFe/sng_rest/api/download/application/archive/nsc.archive.17 
result : HTTP/1.0 404 Not Found
 *
 * */
?>