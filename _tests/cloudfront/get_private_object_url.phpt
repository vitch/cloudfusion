--TEST--
CloudFront: get_private_object_url() testing url generation

--FILE--
<?php
	// Dependencies
	require_once dirname(__FILE__) . '/../../cloudfusion.class.php';

	// Generate configuration XML
	$cdn = new AmazonCloudFront();
	
	// Read private key file
	if($key_file = fopen('rsa-private-key.pem', "r"))
	{
	$priv_key = fread($key_file, 8192);
	fclose($key_file);
	$pkeyid = openssl_get_privatekey($priv_key);
	}
	
	$cdn->set_domain('p1dcedm05cjidz1.cloudfront.net');
	$cdn->set_key_pair_id('ACVAD62RGVXHNO6TVPX9');
	$cdn->set_private_key($pkeyid);
	
	$url = $cdn->get_private_object_url('myfile.mp4', array('IpAddress'=>'73.121.132.9','DateLessThan'=>3600));
	
	// free the key from memory
	openssl_free_key($pkeyid);

	// Success?
	var_dump($url);
?>

--EXPECTF--
string(%d) "%s"
