<?php
/*
 * sip profile create 
*/
include_once 'setting.inc.php';      
require_once PEST_PATH.'pest/PestJSON.php';

$options['server'] = 'http://' . SERVER;
$options['request'] = 'POST';

$base_url = $options['server'] .'/SAFe/sng_rest/api/';
$method_name = 'create';
$module_name = 'sip';
$obj_type = 'profile';
$obj_name = 'NSC_SIP_Profile5';

$request_uri =  $method_name .'/'. $module_name .'/'. $obj_type .'/'. $obj_name;

$json_data ='
{
	"user-agent-string": "NetBorder Session Controller",
	"sip-ip": "eth0",
	"ext-sip-ip": "",
	"sip-port": "5066",
	"transport": "udptcp",
	"outbound-proxy": "",
	"rtp-ip": "",
	"ext-rtp-ip": "",
	"inbound-bypass-media": "false",
	"inbound-media-profile": "default",
	"outbound-media-profile": "default",
	"sip-trace": "false",
	"enable-100rel": "false",
	"enable-3pcc": "false",
	"ignore-183nosdp": "false",
	"fqdn-in-contact": "",
	"max-sip-request-length": "",
	"notify-refer-on-final-rsp": "false",
	"lync-interop": "false",
	"enable-timer": "false",
	"session-timeout": 1800,
	"minimum-session-expires": 1800,
	"rtcp-audio-interval-msec": "5000",
	"TLS\/tls-version": "tlsv1",
	"TLS\/certificate": "__none__",
	"TLS\/tls-passphrase": "",
	"TLS\/tls-verify-date": "true",
	"TLS\/tls-verify-policy": "out",
	"TLS\/tls-sip-port": "5061",
	"TLS\/enable-secure-media": "false",
	"srtp\/require-secure-rtp": "false",
	"srtp\/support-sdp-secure-avp": "false",
	"srtp\/crypto-optional-lifetime": "__disable__",
	"srtp\/crypto-optional-mki-length-string": "__disable__",
	"auth-calls": "true",
	"accept-blind-auth": "false",
	"auth-all-packets": "false",
	"sip-tos-value": "",
	"rtp-tos-value": "",
	"apply-nat-acl": "",
	"nat-options-ping": "false",
	"NDLB-force-rport": "false",
	"disable-rtp-auto-adjust": "true",
	"aggressive-nat-detection": "false",
	"enable-load-limit": "true",
	"max-sessions": "",
	"load-limit-high-threshold": "90",
	"load-limit-low-threshold": "80",
	"load-limit-reject-cause": "503",
	"load-limit-cause-string": "Service Unavailable",
	"call-routing": "sip-core-null-routing",
	"sip-dialplan-handler": "default",
	"manual-redirect": "false",
	"full-id-in-dialplan": "false"
}
';
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
get obj successful
{
	"status": true,
	"method": "create",
	"module": "sip",
	"type": "profile",
	"name": "NSC_SIP_Profile5"
}
Status: 200


 *
 * */
?>