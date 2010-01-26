--TEST--
CloudFront: list_distributions() with MaxResults and streaming.

--FILE--
<?php
	// Dependencies
	require_once dirname(__FILE__) . '/../../cloudfusion.class.php';

	// Update the XML content
	$cdn = new AmazonCloudFront();
	$response = $cdn->list_distributions(array(
		'MaxItems' => 1,
		'Streaming' => true
	));

	// Success?
	var_dump($response->isOK());
?>

--EXPECT--
bool(true)
