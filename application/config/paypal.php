<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['Sandbox'] = TRUE;

$config['APIVersion'] = '123.0';

$config['APIUsername'] = $config['Sandbox'] ? 'sandbo_1215254764_biz_api1.angelleye.com' : 'PRODUCTION_USERNAME_GOGES_HERE';
$config['APIPassword'] = $config['Sandbox'] ? '1215254774' : 'PRODUCTION_PASSWORD_GOGES_HERE';
$config['APISignature'] = $config['Sandbox'] ? 'AiKZhEEPLJjSIccz.2M.tbyW5YFwAb6E3l6my.pY9br1z2qxKx96W18v' : 'PRODUCTION_SIGNATURE_GOGES_HERE';

$config['PayFlowUsername'] = $config['Sandbox'] ? 'tester' : '';
$config['PayFlowPassword'] = $config['Sandbox'] ? 'Pr0t3ct!' : '';
$config['PayFlowVendor'] = $config['Sandbox'] ? 'angelleye' : '';
$config['PayFlowPartner'] = $config['Sandbox'] ? 'PayPal' : 'PayPal';

$config['ApplicationID'] = $config['Sandbox'] ? 'APP-80W284485P519543T' : 'PRODUCTION_APP_ID_GOES_HERE';
$config['DeviceID'] = '';
$config['DeviceIpAddress'] = $_SERVER['REMOTE_ADDR'];

$config['DeveloperEmailAccount'] = 'diestone29@gmail.com';

