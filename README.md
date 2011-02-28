# CloudFusion

All that remains of CloudFusion is support for the Amazon Product Advertising API. To use:

1. Download the AWS SDK for PHP via <a href="http://pear.amazonwebservices.com">PEAR</a>, <a href="http://github.com/amazonwebservices/aws-sdk-for-php">GitHub</a> or <a href="http://aws.amazon.com/sdkforphp">ZIP file</a>.
2. Locate the `services` directory which contains files for other AWS services such as `s3.class.php` and `ec2.class.php`.
3. Take the <a href="cloudfusion/blob/master/services/pas.class.php"><code>pas.class.php</code></a> file and add it to the SDK's `services` directory.
4. It might be helpful to define `AWS_ASSOC_ID` in your `config.inc.php` file.

Code away!

	require_once 'sdk.class.php';

	$pas = new AmazonPAS();
	$response = $pas->item_search('red hot chili peppers');
	print_r($response);


## Running Tests

1. Copy the <a href="cloudfusion/blob/master/_tests"><code>_tests</code></a> directory and add it to the root of the SDK directory.
2. Using Terminal, move into the `cloudfusion/_tests/pas` directory.
3. Run: `pear run-tests`.


## Support

For support with the Product Advertising API, visit the [AWS forums](https://forums.aws.amazon.com/forum.jspa?forumID=9). For support with CloudFusion's `AmazonPAS` class specifically, hit up the [mailing list](http://groups.google.com/group/cloudfusion).
