<?php
/**
 * AMAZON SIMPLE STORAGE SERVICE (S3)
 * http://s3.amazonaws.com
 *
 * @category Tarzan
 * @package S3
 * @version 2008.04.12
 * @copyright 2006-2008 LifeNexus Digital, Inc. and contributors.
 * @license http://opensource.org/licenses/bsd-license.php Simplified BSD License
 * @link http://tarzan-aws.googlecode.com Tarzan
 * @link http://s3.amazonaws.com Amazon S3
 * @see README
 */


/*%******************************************************************************************%*/
// CONSTANTS

/**
 * Specify the US location.
 */
define('S3_LOCATION_US', 'us');

/**
 * Specify the European Union (EU) location.
 */
define('S3_LOCATION_EU', 'eu');

/**
 * ACL: Owner-only read/write.
 */
define('S3_ACL_PRIVATE', 'private');

/**
 * ACL: Owner read/write, public read.
 */
define('S3_ACL_PUBLIC', 'public-read');

/**
 * ACL: Public read/write.
 */
define('S3_ACL_OPEN', 'public-read-write');

/**
 * ACL: Owner read/write, authenticated read.
 */
define('S3_ACL_AUTH_READ', 'authenticated-read');


/*%******************************************************************************************%*/
// MAIN CLASS

/**
 * Container for all Amazon S3-related methods.
 */
class AmazonS3 extends TarzanCore
{
	/**
	 * The request URL.
	 */
	var $request_url;


	/*%******************************************************************************************%*/
	// CONSTRUCTOR

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->api_version = '2006-03-01';
		parent::__construct();
	}


	/*%******************************************************************************************%*/
	// AUTHENTICATION

	/**
	 * Authenticate
	 *
	 * Authenticates a connection to AWS. Overridden from TarzanCore.
	 *
	 * @access private
	 * @param string $bucket (Required) The name of the bucket to be used.
	 * @param array $opt Associative array of parameters for authenticating. See the individual methods for allowed keys.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTAuthentication.html
	 */
	public function authenticate($bucket, $opt = null, $location = null, $redirects = 0)
	{
		// If nothing was passed in, don't do anything.
		if (!$opt)
		{
			return false;
		}
		else
		{
			// Set default values
			$acl = null;
			$body = null;
			$contentType = null;
			$delimiter = null;
			$filename = null;
			$marker = null;
			$maxKeys = null;
			$method = null;
			$prefix = null;
			$verb = null;
			$hostname = $bucket . '.s3.amazonaws.com';

			// Break the array into individual variables, while storing the original.
			$_opt = $opt;
			extract($opt);

			// Get the UTC timestamp in RFC 2616 format
			$httpDate = gmdate(DATE_AWS_RFC2616, time());

			// Generate the request string
			//$request = $bucket;
			$request = '';

			// Append additional parameters
			$request .= '/' . $filename;

			// List Object settings
			if (isset($method) && !empty($method) && $method == 'list_objects')
			{
				if (isset($prefix) && !empty($prefix))
				{
					$request = '/?prefix=' . $prefix;
				}
				else if (isset($marker) && !empty($marker))
				{
					$request = '/?marker=' . $marker;
				}
				else if (isset($maxKeys) && !empty($maxKeys))
				{
					$request = '/?max-keys=' . $maxKeys;
				}
				else if (isset($delimiter) && !empty($delimiter))
				{
					$request = '/?delimiter=' . $delimiter;
				}
			}

			// Get Bucket Locale settings
			if (isset($method) && !empty($method) && $method == 'get_bucket_locale')
			{
				$request = '/?location';
				$filename = '?location';
			}

			if (!$request == '/')
			{
				$request = '/' . $request;
			}

			// Prepare the request.
			if ($location)
			{
				$this->request_url = $location;
			}
			else
			{
				$this->request_url = 'http://' . $hostname . $request;
			}
			$req =& new HTTP_Request($this->request_url);
			$req->addHeader('User-Agent', TARZAN_USERAGENT);

			// Do we have a verb?
			if (isset($verb) && !empty($verb))
			{
				$req->setMethod($verb);
			}

			// Do we have a contentType?
			if (isset($contentType) && !empty($contentType))
			{
				$req->addHeader("Content-Type", $contentType);
			}

			// Do we have a date?
			if (isset($httpDate) && !empty($httpDate))
			{
				$req->addHeader("Date", $httpDate);
			}

			// Do we have ACL settings? (Optional in signed string)
			if (isset($acl) && !empty($acl))
			{
				$req->addHeader("x-amz-acl", $acl);
				$acl = 'x-amz-acl:' . $acl . "\n";
			}

			// Add a body if we're creating
			if ($method == 'create_object' || $method == 'create_bucket')
			{
				if (isset($body) && !empty($body))
				{
					$req->setBody($body);
				}
			}

			// Data that will be "signed".
			$filename = '/' . $filename;
			$stringToSign = "$verb\n\n$contentType\n$httpDate\n$acl/$bucket$filename";

			// Hash the AWS secret key
			$hasher =& new Crypt_HMAC($this->secret_key, 'sha1');

			// Generate a signature for the request.
			$signature = $this->util->hex_to_base64($hasher->hash($stringToSign));

			// Pass the developer key and signature
			$req->addHeader("Authorization", "AWS " . $this->key . ":" . $signature);

			// Send!
			$req->sendRequest();

			// Prepare the response.
			$headers = $req->getResponseHeader();
			$headers['x-amz-httpstatus'] = $req->getResponseCode();
			$headers['x-amz-redirects'] = $redirects;
			$headers['x-amz-requesturl'] = $this->request_url;
			$headers['x-amz-stringtosign'] = $stringToSign;
			$data = new TarzanHTTPResponse($headers, $req->getResponseBody());

			// Did Amazon tell us to redirect? Typically happens for multiple rapid requests EU datacenters.
			// @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/Redirects.html
			if ((int) $headers['x-amz-httpstatus'] == 307) // Temporary redirect to new endpoint.
			{
				$redirects++;
				$data = $this->authenticate($bucket, 
					$_opt, 
					$headers['location'], 
					$redirects);
			}

			// Return!
			return $data;
		}
	}


	/*%******************************************************************************************%*/
	// BUCKET METHODS

	/**
	 * Create Bucket
	 *
	 * The bucket holds all of your objects, and provides a globally unique namespace in which you 
	 * can manage the keys that identify objects. A bucket can hold any number of objects.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to create.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTBucketPUT.html
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/UsingBucket.html
	 */
	public function create_bucket($bucket, $locale = null)
	{
		// Defaults
		$body = null;
		$contentType = null;

		if ($locale)
		{
			switch(strtolower($locale))
			{
				case 'eu':
					$body = '<CreateBucketConfiguration><LocationConstraint>' . strtoupper($locale) . '</LocationConstraint></CreateBucketConfiguration>';
					$contentType = 'application/xml';
					break;
			}
		}

		// Authenticate to S3
		return $this->authenticate($bucket, array(
			'verb' => 'PUT',
			'method' => 'create_bucket',
			'body' => $body,
			'contentType' => $contentType
		));
	}


	/**
	 * Get Bucket
	 *
	 * Referred to as "GET Bucket" in the AWS docs, but implemented here as AmazonS3::list_objects().
	 */
	private function get_bucket() {}


	/**
	 * Get Bucket Locale
	 *
	 * Lists the location constraint of the bucket. U.S.-based buckets have no response.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to check.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTBucketLocationGET.html
	 */
	public function get_bucket_locale($bucket)
	{
		// Add this to our request
		$opt = array();
		$opt['verb'] = 'GET';
		$opt['method'] = 'get_bucket_locale';

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Delete Bucket
	 *
	 * All objects in the bucket must be deleted before the bucket itself can be deleted.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to create.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTBucketDELETE.html
	 */
	public function delete_bucket($bucket)
	{
		// Add this to our request
		$opt = array();
		$opt['verb'] = 'DELETE';
		$opt['method'] = 'delete_bucket';

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Post Object
	 *
	 * Not yet implemented.
	 */
	private function post_object() {}


	/*%******************************************************************************************%*/
	// OBJECT METHODS

	/**
	 * Create Object
	 *
	 * Once you have a bucket, you can start storing objects in it. Objects are stored using the HTTP 
	 * PUT method. Each object can hold up to 5 GB of data. When you store an object, S3 streams the 
	 * data to multiple storage servers in multiple data centers to ensure that the data remains 
	 * available in the event of internal network or hardware failure.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to be used.
 	 * @param array $opt (Required) Associative array of parameters which can have the following keys:
	 * <ul>
	 *   <li>string filename - (Required) The filename for the content.</li>
	 *   <li>string body - (Required) The data to be stored in the object.</li>
	 *   <li>string contentType - (Required) The type of content that is being sent in the body.</li>
	 *   <li>string acl - (Optional) One of the following options: S3_ACL_PRIVATE, S3_ACL_PUBLIC, S3_ACL_OPEN, or S3_ACL_AUTH_READ. Defaults to S3_ACL_PRIVATE.</li>
	 * </ul>
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTObjectPUT.html
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTAccessPolicy.html
	 */
	public function create_object($bucket, $opt = null)
	{
		// Add this to our request
		$opt['verb'] = 'PUT';
		$opt['method'] = 'create_object';

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Reads the contents of an object within a bucket.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to be used.
	 * @param string $filename (Required) The filename for the content.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTObjectGET.html
	 */
	public function get_object($bucket, $filename)
	{
		// Add this to our request
		$opt = array();
		$opt['verb'] = 'GET';
		$opt['method'] = 'get_object';
		$opt['filename'] = $filename;

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Reads only the HTTP headers of an object within a bucket.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to be used.
	 * @param string $filename (Required) The filename for the content.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTObjectHEAD.html
	 */
	public function head_object($bucket, $filename)
	{
		// Add this to our request
		$opt = array();
		$opt['verb'] = 'HEAD';
		$opt['method'] = 'head_object';
		$opt['filename'] = $filename;

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Deletes an object within a bucket.
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to be used.
	 * @param string $filename (Required) The filename for the content.
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/RESTObjectDELETE.html
	 */
	public function delete_object($bucket, $filename)
	{
		// Add this to our request
		$opt = array();
		$opt['verb'] = 'DELETE';
		$opt['method'] = 'delete_object';
		$opt['filename'] = $filename;

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}


	/**
	 * Lists the objects in a bucket
	 *
	 * @access public
	 * @param string $bucket (Required) The name of the bucket to be used.
 	 * @param array $opt (Optional) Associative array of parameters which can have the following keys:
	 * <ul>
	 *   <li>string prefix - (Optional) Restricts the response to only contain results that begin with the specified prefix.</li>
	 *   <li>string marker - (Optional) It restricts the response to only contain results that occur alphabetically after the value of marker.</li>
	 *   <li>string maxKeys - (Optional) Limits the number of results returned in response to your query. Will return no more than this number of results, but possibly less.</li>
	 *   <li>string delimiter - (Optional) Unicode string parameter. Keys that contain the same string between the prefix and the first occurrence of the delimiter will be rolled up into a single result element in the CommonPrefixes collection.</li>
	 * </ul>
	 * @return object A TarzanHTTPResponse response object.
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/gsg/ListKeys.html
	 * @see http://docs.amazonwebservices.com/AmazonS3/2006-03-01/ListingKeysRequest.html
	 */
	public function list_objects($bucket, $opt = null)
	{
		// Add this to our request
		$opt['verb'] = 'GET';
		$opt['method'] = 'list_objects';

		// Authenticate to S3
		return $this->authenticate($bucket, $opt);
	}
}
?>