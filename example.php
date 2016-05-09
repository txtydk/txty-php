<?php
// Include class
include 'txty.class.php';

// Initiate authentication
$authentication = new Authentication('user', 'key');

// Initiate SMS
$sms = new TxtySMS($authentication);

// Send SMS
$result = $sms->sendSMS([
	'msisdn' => 4512345678,
	'sender' => 'TestClass',
	'text' => 'Test class text'
]);

// Get result
echo '<pre>';
print_r($result);
echo '</pre>';

// Show status
echo 'Status: ' . ($result['status'] == 'success' ? 'Success' : 'Failed') . "<br />\n";

if($result['status'] == 'success')
{
	echo 'Cost: ' . $result['sms']['cost'] . ' DKK' . "<br />\n";
	echo 'Message: ' . $result['sms']['msg-count'] . ' (' . $result['sms']['chars-count'] . ' chars)' . "<br />\n";
	echo 'Sent to dialcode: ' . $result['sms']['dialcode'] . "<br />\n";
}