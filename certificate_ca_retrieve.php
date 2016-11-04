<?php
/*
 * certificate ca retrieve 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'GET';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'retrieve';
$module_name = 'certificate';
$obj_type = 'ca';
$obj_name = 'google.com.pem';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;


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

get obj successful
{
	"status": true,
	"method": "retrieve",
	"module": "certificate",
	"type": "ca",
	"name": "google.com.pem",
	"data": {
		"name": "google.com.pem",
		"issuer": "Google Internet Authority",
		"subject": "*.google.com",
		"expires": "2013-10-31 19:59:59",
		"certificate-file-contents": "LS0tLS1CRUdJTiBDRVJUSUZJQ0FURS0tLS0tDQpNSUlGOERDQ0JWbWdBd0lCQWdJS1lGT0I5UUFCQUFDSXZUQU5CZ2txaGtpRzl3MEJBUVVGQURCR01Rc3dDUVlEDQpWUVFHRXdKVlV6RVRNQkVHQTFVRUNoTUtSMjl2WjJ4bElFbHVZekVpTUNBR0ExVUVBeE1aUjI5dloyeGxJRWx1DQpkR1Z5Ym1WMElFRjFkR2h2Y21sMGVUQWVGdzB4TXpBMU1qSXhOVFE1TURSYUZ3MHhNekV3TXpFeU16VTVOVGxhDQpNR1l4Q3pBSkJnTlZCQVlUQWxWVE1STXdFUVlEVlFRSUV3cERZV3hwWm05eWJtbGhNUll3RkFZRFZRUUhFdzFODQpiM1Z1ZEdGcGJpQldhV1YzTVJNd0VRWURWUVFLRXdwSGIyOW5iR1VnU1c1ak1SVXdFd1lEVlFRREZBd3FMbWR2DQpiMmRzWlM1amIyMHdXVEFUQmdjcWhrak9QUUlCQmdncWhrak9QUU1CQndOQ0FBUm1TcElVYkNxaFVCcTFVd25SDQpBaTcvVE5TazZXOEptYXNSK0kwci9OTERZdjV5QXBiQXo4SFhYTjhoRGR1ck1SUDZKeTFRMFVJS215bHM4SFBIDQpleG9DbzRJRUNqQ0NCQVl3SFFZRFZSMGxCQll3RkFZSUt3WUJCUVVIQXdFR0NDc0dBUVVGQndNQ01Bc0dBMVVkDQpEd1FFQXdJSGdEQWRCZ05WSFE0RUZnUVVVM2pUME5WTlJnVTVaaW5SSEdybHlvR0Vub1l3SHdZRFZSMGpCQmd3DQpGb0FVdjhBdzYvVkRFVDVudXA2UisveHEydU5yRWlRd1d3WURWUjBmQkZRd1VqQlFvRTZnVElaS2FIUjBjRG92DQpMM2QzZHk1bmMzUmhkR2xqTG1OdmJTOUhiMjluYkdWSmJuUmxjbTVsZEVGMWRHaHZjbWwwZVM5SGIyOW5iR1ZKDQpiblJsY201bGRFRjFkR2h2Y21sMGVTNWpjbXd3WmdZSUt3WUJCUVVIQVFFRVdqQllNRllHQ0NzR0FRVUZCekFDDQpoa3BvZEhSd09pOHZkM2QzTG1kemRHRjBhV011WTI5dEwwZHZiMmRzWlVsdWRHVnlibVYwUVhWMGFHOXlhWFI1DQpMMGR2YjJkc1pVbHVkR1Z5Ym1WMFFYVjBhRzl5YVhSNUxtTnlkREFNQmdOVkhSTUJBZjhFQWpBQU1JSUN3d1lEDQpWUjBSQklJQ3VqQ0NBcmFDRENvdVoyOXZaMnhsTG1OdmJZSU5LaTVoYm1SeWIybGtMbU52YllJV0tpNWhjSEJsDQpibWRwYm1VdVoyOXZaMnhsTG1OdmJZSVNLaTVqYkc5MVpDNW5iMjluYkdVdVkyOXRnaFlxTG1kdmIyZHNaUzFoDQpibUZzZVhScFkzTXVZMjl0Z2dzcUxtZHZiMmRzWlM1allZSUxLaTVuYjI5bmJHVXVZMnlDRGlvdVoyOXZaMnhsDQpMbU52TG1sdWdnNHFMbWR2YjJkc1pTNWpieTVxY0lJT0tpNW5iMjluYkdVdVkyOHVkV3VDRHlvdVoyOXZaMnhsDQpMbU52YlM1aGNvSVBLaTVuYjI5bmJHVXVZMjl0TG1GMWdnOHFMbWR2YjJkc1pTNWpiMjB1WW5LQ0R5b3VaMjl2DQpaMnhsTG1OdmJTNWpiNElQS2k1bmIyOW5iR1V1WTI5dExtMTRnZzhxTG1kdmIyZHNaUzVqYjIwdWRIS0NEeW91DQpaMjl2WjJ4bExtTnZiUzUyYm9JTEtpNW5iMjluYkdVdVpHV0NDeW91WjI5dloyeGxMbVZ6Z2dzcUxtZHZiMmRzDQpaUzVtY29JTEtpNW5iMjluYkdVdWFIV0NDeW91WjI5dloyeGxMbWwwZ2dzcUxtZHZiMmRzWlM1dWJJSUxLaTVuDQpiMjluYkdVdWNHeUNDeW91WjI5dloyeGxMbkIwZ2c4cUxtZHZiMmRzWldGd2FYTXVZMjZDRkNvdVoyOXZaMnhsDQpZMjl0YldWeVkyVXVZMjl0Z2cwcUxtZHpkR0YwYVdNdVkyOXRnZ3dxTG5WeVkyaHBiaTVqYjIyQ0VDb3VkWEpzDQpMbWR2YjJkc1pTNWpiMjJDRmlvdWVXOTFkSFZpWlMxdWIyTnZiMnRwWlM1amIyMkNEU291ZVc5MWRIVmlaUzVqDQpiMjJDRmlvdWVXOTFkSFZpWldWa2RXTmhkR2x2Ymk1amIyMkNDeW91ZVhScGJXY3VZMjl0Z2d0aGJtUnliMmxrDQpMbU52YllJRVp5NWpiNElHWjI5dkxtZHNnaFJuYjI5bmJHVXRZVzVoYkhsMGFXTnpMbU52YllJS1oyOXZaMnhsDQpMbU52YllJU1oyOXZaMnhsWTI5dGJXVnlZMlV1WTI5dGdncDFjbU5vYVc0dVkyOXRnZ2g1YjNWMGRTNWlaWUlMDQplVzkxZEhWaVpTNWpiMjJDRkhsdmRYUjFZbVZsWkhWallYUnBiMjR1WTI5dE1BMEdDU3FHU0liM0RRRUJCUVVBDQpBNEdCQUFNbjBLM2ozeWhDK1grdXloNmVBQmEyRXE3eGlZNS9tVUI4ODZJcjE5dnhsdVNNTktENm4vaVk4dkhqDQp0cm4wQmh1Vzgvdm1KeXVkRmtJY0VEVVlFNGl2UU1sc2ZJTDdTT0d3Nk9ldlZMbW0wMmFpUkhXajVUMjBEcytTDQpPcHVlWVVHM05CY0hQLzVJemhVWUlRSmJHemxRYVVhWkJNYVFlQzhac2xNTkxXSTINCi0tLS0tRU5EIENFUlRJRklDQVRFLS0tLS0NCg==",
		"certificate-file-name": "google.com.pem"
	}
}Status: 200

 *
 * */
?>