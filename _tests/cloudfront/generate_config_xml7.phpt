--TEST--
CloudFront: generate_config_xml(), with streaming

--FILE--
<?php
	// Dependencies
	require_once dirname(__FILE__) . '/../../cloudfusion.class.php';

	// Generate configuration XML
	$cdn = new AmazonCloudFront();
	$response = $cdn->generate_config_xml('warpshare.test', 'WarpShareS3', array(
		'Streaming' => true
	));

	// Success?
	var_dump($response);
?>

--EXPECTF--
string(%d) "%s"
