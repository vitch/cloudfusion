--TEST--
CloudFront: set_distribution_config() with streaming.

--FILE--
<?php
	// Dependencies
	require_once dirname(__FILE__) . '/../../cloudfusion.class.php';

	// Retrieve the cached Distribution ID. See create_distribution() for why we're doing this.
	$distribution_id = file_get_contents('create_distribution_stream.cache');

	$cdn = new AmazonCloudFront();

	// Pull existing config XML...
	$existing_xml = $cdn->get_distribution_config($distribution_id, array(
		'Streaming' => true
	));

	// Generate an updated XML config...
	$updated_xml = $cdn->update_config_xml($existing_xml, array(
		'Enabled' => false,
		'Streaming' => true
	));

	// Fetch an updated ETag value
	$etag = $cdn->get_distribution_config($distribution_id, array(
		'Streaming' => true
	))->header['etag'];

	// Set the updated config XML to the distribution.
	$response = $cdn->set_distribution_config($distribution_id, $updated_xml, $etag, array(
		'Streaming' => true
	));

	// Success?
	var_dump($response->isOK());
?>

--EXPECT--
bool(true)
