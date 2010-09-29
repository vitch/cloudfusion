<?php
<<<<<<< HEAD
/**
 * File: Amazon EC2
 * 	Amazon Elastic Compute Cloud (http://aws.amazon.com/ec2)
 *
 * Version:
 * 	2010.01.10
 *
 * Copyright:
 * 	2006-2010 Ryan Parman, Foleeo, Inc., and contributors.
 *
 * License:
 * 	Simplified BSD License - http://opensource.org/licenses/bsd-license.php
 *
 * See Also:
 * 	CloudFusion - http://getcloudfusion.com
 * 	Amazon EC2 - http://aws.amazon.com/ec2
 */


/*%******************************************************************************************%*/
// CONSTANTS

/**
 * Constant: EC2_DEFAULT_URL
 * 	Specify the default queue URL.
 */
define('EC2_DEFAULT_URL', 'ec2.amazonaws.com');

/**
 * Constant: EC2_LOCATION_US
 * 	Specify the queue URL for the U.S.-specific hostname.
 */
define('EC2_LOCATION_US', 'us-east-1.');

/**
 * Constant: EC2_LOCATION_EU
 * 	Specify the queue URL for the E.U.-specific hostname.
 */
define('EC2_LOCATION_EU', 'eu-west-1.');
=======
/*
 * Copyright 2010 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 *  http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

/**
 * File: AmazonEC2
 * 	Amazon Elastic Compute Cloud (Amazon EC2) is a web service that provides resizable compute capacity
 * 	in the cloud. It is designed to make web-scale computing easier for developers.
 *
 * 	Amazon EC2's simple web service interface allows you to obtain and configure capacity with minimal
 * 	friction. It provides you with complete control of your computing resources and lets you run on
 * 	Amazon's proven computing environment. Amazon EC2 reduces the time required to obtain and boot new
 * 	server instances to minutes, allowing you to quickly scale capacity, both up and down, as your
 * 	computing requirements change. Amazon EC2 changes the economics of computing by allowing you to pay
 * 	only for capacity that you actually use. Amazon EC2 provides developers the tools to build failure
 * 	resilient applications and isolate themselves from common failure scenarios.
 *
 * 	Visit [http://aws.amazon.com/ec2/](http://aws.amazon.com/ec2/) for more information.
 *
 * Version:
 * 	Mon Sep 27 19:42:00 PDT 2010
 *
 * License and Copyright:
 * 	See the included NOTICE.md file for complete information.
 *
 * See Also:
 * 	[Amazon Elastic Compute Cloud](http://aws.amazon.com/ec2/)
 * 	[Amazon Elastic Compute Cloud documentation](http://aws.amazon.com/documentation/ec2/)
 */
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb


/*%******************************************************************************************%*/
// EXCEPTIONS

/**
 * Exception: EC2_Exception
 * 	Default EC2 Exception.
 */
class EC2_Exception extends Exception {}


/*%******************************************************************************************%*/
// MAIN CLASS

/**
 * Class: AmazonEC2
<<<<<<< HEAD
 * 	Container for all Amazon EC2-related methods. Inherits additional methods from CloudFusion.
 *
 * Extends:
 * 	CloudFusion
 *
 * Example Usage:
 * (start code)
 * require_once('cloudfusion.class.php');
 *
 * // Instantiate a new AmazonEC2 object using the settings from the config.inc.php file.
 * $s3 = new AmazonEC2();
 *
 * // Instantiate a new AmazonEC2 object using these specific settings.
 * $s3 = new AmazonEC2($key, $secret_key);
 * (end)
 */
class AmazonEC2 extends CloudFusion
{
	/**
	 * Property: hostname
	 * Stores the hostname to use to make the request.
	 */
	var $hostname;


	/*%******************************************************************************************%*/
	// CONSTRUCTOR

	/**
	 * Method: __construct()
	 * 	The constructor
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	key - _string_ (Optional) Your Amazon API Key. If blank, it will look for the <AWS_KEY> constant.
	 * 	secret_key - _string_ (Optional) Your Amazon API Secret Key. If blank, it will look for the <AWS_SECRET_KEY> constant.
	 * 	account_id - _string_ (Optional) Your Amazon Account ID, without hyphens. If blank, it will look for the <AWS_ACCOUNT_ID> constant.
	 *
	 * Returns:
	 * 	_boolean_ false if no valid values are set, otherwise true.
 	 *
	 * See Also:
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/__construct.phps
	 */
	public function __construct($key = null, $secret_key = null, $account_id = null)
	{
		$this->api_version = '2008-12-01';
		$this->hostname = EC2_DEFAULT_URL;

		if (!$key && !defined('AWS_KEY'))
		{
			throw new EC2_Exception('No account key was passed into the constructor, nor was it set in the AWS_KEY constant.');
		}

		if (!$secret_key && !defined('AWS_SECRET_KEY'))
		{
			throw new EC2_Exception('No account secret was passed into the constructor, nor was it set in the AWS_SECRET_KEY constant.');
		}

		if (!$account_id && !defined('AWS_ACCOUNT_ID'))
		{
			throw new EC2_Exception('No Amazon account ID was passed into the constructor, nor was it set in the AWS_ACCOUNT_ID constant.');
		}

		return parent::__construct($key, $secret_key, $account_id);
	}


	/*%******************************************************************************************%*/
	// MISCELLANEOUS

	/**
	 * Method: set_locale()
	 * 	By default EC2 will self-select the most appropriate locale. This allows you to explicitly sets the locale for EC2 to use.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	locale - _string_ (Required) The locale to explicitly set for EC2. Available options are <EC2_LOCATION_US> and <EC2_LOCATION_EU>.
	 *
	 * Returns:
	 * 	void
 	 *
	 * See Also:
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/set_locale.phps
	 */
	public function set_locale($locale)
	{
		$this->hostname = $locale . EC2_DEFAULT_URL;
	}


	/*%******************************************************************************************%*/
	// AVAILABILITY ZONES

	/**
	 * Method: describe_availability_zones()
	 * 	Describes availability zones that are currently available to the account and their states.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	ZoneName.n - _string_ (Optional) Name of an availability zone.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeAvailabilityZones.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/describe_availability_zones.phps
	 */
	public function describe_availability_zones($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeAvailabilityZones', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// ELASTIC IP ADDRESSES

	/**
	 * Method: allocate_address()
	 * 	Acquires an elastic IP address for use with your account.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-AllocateAddress.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <associate_address()>, <describe_addresses()>, <disassociate_address()>, <release_address()>
	 */
	public function allocate_address($returnCurlHandle = null)
	{
		$opt = array();
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('AllocateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: associate_address()
	 * 	Associates an elastic IP address with an instance.
	 *
	 * 	If the IP address is currently assigned to another instance, the IP address is assigned to the new instance. This is an idempotent operation. If you enter it more than once, Amazon EC2 does not return an error.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	instance_id - _string_ (Required) The instance to which the IP address is assigned.
	 * 	public_ip - _string_ (Required) IP address that you are assigning to the instance, retrieved from <allocate_address()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-AssociateAddress.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <allocate_address()>, <describe_addresses()>, <disassociate_address()>, <release_address()>
	 */
	public function associate_address($instance_id, $public_ip, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['PublicIp'] = $public_ip;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('AssociateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: describe_addresses()
	 * 	Lists elastic IP addresses assigned to your account.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	PublicIp.1 - _string_ (Required but can be empty) One Elastic IP addresses to describe.
	 * 	PublicIp.n - _string_ (Optional) More than one Elastic IP addresses to describe.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeAddresses.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <allocate_address()>, <associate_address()>, <disassociate_address()>, <release_address()>
	 */
	public function describe_addresses($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeAddresses', $opt, $this->hostname);
	}

	/**
	 * Method: disassociate_address()
	 * 	Disassociates the specified elastic IP address from the instance to which it is assigned.
	 *
	 * 	This is an idempotent operation. If you enter it more than once, Amazon EC2 does not return an error.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	public_ip - _string_ (Required) IP address that you are disassociating from the instance.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DisassociateAddress.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <allocate_address()>, <associate_address()>, <describe_addresses()>, <release_address()>
	 */
	public function disassociate_address($public_ip, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['PublicIp'] = $public_ip;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DisassociateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: release_address()
	 * 	Releases an elastic IP address associated with your account. If you run this operation on an elastic IP address that is already released, the address might be assigned to another account which will cause Amazon EC2 to return an error.
	 *
	 * 	Releasing an IP address automatically disassociates it from any instance with which it is associated. For more information, see <disassociate_address()>.
	 *
	 * 	After releasing an elastic IP address, it is released to the IP address pool and might no longer be available to your account. Make sure to update your DNS records and any servers or devices that communicate with the address.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	public_ip - _string_ (Required) IP address that you are releasing from your account.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-ReleaseAddress.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <allocate_address()>, <associate_address()>, <describe_addresses()>, <disassociate_address()>
	 */
	public function release_address($public_ip, $returnCurlHandle = null)
	{
		if (!$opt) $opt = array();
		$opt['PublicIp'] = $public_ip;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('ReleaseAddress', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// EBS SNAPSHOTS TO S3

	/**
	 * Method: create_snapshot()
	 * 	Creates a snapshot of an Amazon EBS volume and stores it in Amazon S3. You can use snapshots for backups, to launch instances from identical snapshots, and to save data before shutting down an instance. For more information, see Amazon Elastic Block Store.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	volume_id - _string_ (Required) The ID of the Amazon EBS volume to snapshot. Must be a volume that you own.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-CreateSnapshot.html
	 * 	Related - <describe_snapshots()>, <delete_snapshot()>
	 */
	public function create_snapshot($volume_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['VolumeId'] = $volume_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;
=======
 * 	Container for all service-related methods.
 */
class AmazonEC2 extends CFRuntime
{

	/*%******************************************************************************************%*/
	// CLASS CONSTANTS

	/**
	 * Constant: DEFAULT_URL
	 * 	Specify the default queue URL.
	 */
	const DEFAULT_URL = 'ec2.amazonaws.com';

	/**
	 * Constant: REGION_US_E1
	 * 	Specify the queue URL for the US-East (Northern Virginia) Region.
	 */
	const REGION_US_E1 = 'us-east-1';

	/**
	 * Constant: REGION_US_W1
	 * 	Specify the queue URL for the US-West (Northern California) Region.
	 */
	const REGION_US_W1 = 'us-west-1';

	/**
	 * Constant: REGION_EU_W1
	 * 	Specify the queue URL for the EU (Ireland) Region.
	 */
	const REGION_EU_W1 = 'eu-west-1';

	/**
	 * Constant: REGION_APAC_SE1
	 * 	Specify the queue URL for the Asia Pacific (Singapore) Region.
	 */
	const REGION_APAC_SE1 = 'ap-southeast-1';

	/**
	 * Constant: STATE_PENDING
	 * 	The "pending" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_PENDING = 0;

	/**
	 * Constant: STATE_RUNNING
	 * 	The "running" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_RUNNING = 16;

	/**
	 * Constant: STATE_SHUTTING_DOWN
	 * 	The "shutting-down" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_SHUTTING_DOWN = 32;

	/**
	 * Constant: STATE_TERMINATED
	 * 	The "terminated" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_TERMINATED = 48;

	/**
	 * Constant: STATE_STOPPING
	 * 	The "stopping" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_STOPPING = 64;

	/**
	 * Constant: STATE_STOPPED
	 * 	The "stopped" state code of an EC2 instance. Useful for conditionals.
	 */
	const STATE_STOPPED = 80;


	/*%******************************************************************************************%*/
	// SETTERS

	/**
	 * Method: set_region()
	 * 	This allows you to explicitly sets the region for the service to use.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	$region - _string_ (Required) The region to explicitly set. Available options are <REGION_US_E1>, <REGION_US_W1>, <REGION_EU_W1>, or <REGION_APAC_SE1>.
	 *
	 * Returns:
	 * 	`$this`
	 */
	public function set_region($region)
	{
		$this->set_hostname('http://ec2.'. $region .'.amazonaws.com');
		return $this;
	}


	/*%******************************************************************************************%*/
	// CONSTRUCTOR

	/**
	 * Method: __construct()
	 * 	Constructs a new instance of <AmazonEC2>.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	$key - _string_ (Optional) Your Amazon API Key. If blank, it will look for the <AWS_KEY> constant.
	 * 	$secret_key - _string_ (Optional) Your Amazon API Secret Key. If blank, it will look for the <AWS_SECRET_KEY> constant.
	 *
	 * Returns:
	 * 	_boolean_ false if no valid values are set, otherwise true.
	 */
	public function __construct($key = null, $secret_key = null)
	{
		$this->api_version = '2010-08-31';
		$this->hostname = self::DEFAULT_URL;

		if (!$key && !defined('AWS_KEY'))
		{
			throw new EC2_Exception('No account key was passed into the constructor, nor was it set in the AWS_KEY constant.');
		}

		if (!$secret_key && !defined('AWS_SECRET_KEY'))
		{
			throw new EC2_Exception('No account secret was passed into the constructor, nor was it set in the AWS_SECRET_KEY constant.');
		}

		return parent::__construct($key, $secret_key);
	}


	/*%******************************************************************************************%*/
	// SERVICE METHODS

	/**
	 * Method: reboot_instances()
	 * 	The RebootInstances operation requests a reboot of one or more instances. This operation is
	 * 	asynchronous; it only queues a request to reboot the specified instance(s). The operation will
	 * 	succeed if the instances are valid and belong to the user. Requests to reboot terminated instances
	 * 	are ignored.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of instances to terminate. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function reboot_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('RebootInstances', $opt, $this->hostname);
	}

	/**
	 * Method: describe_placement_groups()
	 * 	Returns information about one or more PlacementGroup instances in a user's account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	GroupName - _string_|_array_ (Optional) The name of the `PlacementGroup`. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional)  A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_placement_groups($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['GroupName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'GroupName' => (is_array($opt['GroupName']) ? $opt['GroupName'] : array($opt['GroupName']))
			)));
			unset($opt['GroupName']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribePlacementGroups', $opt, $this->hostname);
	}

	/**
	 * Method: run_instances()
	 * 	The RunInstances operation launches a specified number of instances.
	 *
	 * 	If Amazon EC2 cannot launch the minimum number AMIs you request, no instances launch. If there is
	 * 	insufficient capacity to launch the maximum number of AMIs you request, Amazon EC2 launches as many
	 * 	as possible to satisfy the requested maximum values.
	 *
	 * 	Every instance is launched in a security group. If you do not specify a security group at launch,
	 * 	the instances start in your default security group. For more information on creating security
	 * 	groups, see CreateSecurityGroup.
	 *
	 * 	An optional instance type can be specified. For information about instance types, see Instance
	 * 	Types.
	 *
	 * 	You can provide an optional key pair ID for each image in the launch request (for more information,
	 * 	see CreateKeyPair). All instances that are created from images that use this key pair will have
	 * 	access to the associated public key at boot. You can use this key to provide secure access to an
	 * 	instance of an image on a per-instance basis. Amazon EC2 public images use this feature to provide
	 * 	secure access without passwords.
	 *
	 * 	Launching public images without a key pair ID will leave them inaccessible.
	 *
	 * 	The public key material is made available to the instance at boot time by placing it in the
	 * 	openssh_id.pub file on a logical device that is exposed to the instance as /dev/sda2 (the ephemeral
	 * 	store). The format of this file is suitable for use as an entry within ~/.ssh/authorized_keys (the
	 * 	OpenSSH format). This can be done at boot (e.g., as part of rc.local) allowing for secure access
	 * 	without passwords.
	 *
	 * 	Optional user data can be provided in the launch request. All instances that collectively comprise
	 * 	the launch request have access to this data For more information, see Instance Metadata.
	 *
	 * 	If any of the AMIs have a product code attached for which the user has not subscribed, the
	 * 	RunInstances call will fail.
	 *
	 * 	We strongly recommend using the 2.6.18 Xen stock kernel with the c1.medium and c1.xlarge instances.
	 * 	Although the default Amazon EC2 kernels will work, the new kernels provide greater stability and
	 * 	performance for these instance types. For more information about kernels, see Kernels, RAM Disks,
	 * 	and Block Device Mappings.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_id - _string_ (Required) Unique ID of a machine image, returned by a call to DescribeImages.
	 *	$min_count - _integer_ (Required) Minimum number of instances to launch. If the value is more than Amazon EC2 can launch, no instances are launched at all.
	 *	$max_count - _integer_ (Required) Maximum number of instances to launch. If the value is more than Amazon EC2 can launch, the largest possible number above minCount will be launched instead. Between 1 and the maximum number allowed for your account (default: 20).
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	KeyName - _string_ (Optional) The name of the key pair.
	 *	SecurityGroup - _string_|_array_ (Optional) The names of the security groups into which the instances will be launched. Pass a string for a single value, or an indexed array for multiple values..
	 *	UserData - _string_ (Optional) Specifies additional information to make available to the instance(s).
	 *	InstanceType - _string_ (Optional) Specifies the instance type for the launched instances. [Allowed values: `t1.micro`, `m1.small`, `m1.large`, `m1.xlarge`, `m2.xlarge`, `m2.2xlarge`, `m2.4xlarge`, `c1.medium`, `c1.xlarge`, `cc1.4xlarge`]
	 *	Placement - _ComplexType_ (Optional) Specifies the placement constraints (Availability Zones) for launching the instances. A ComplexType can be set two ways: by setting each individual `Placement` subtype (documented next), or by passing a nested associative array with the following `Placement`-prefixed entries as keys.
	 *	Placement.AvailabilityZone - _string_ (Optional) The availability zone in which an Amazon EC2 instance runs.
	 *	Placement.GroupName - _string_ (Optional) The name of a PlacementGroup.
	 *	KernelId - _string_ (Optional) The ID of the kernel with which to launch the instance.
	 *	RamdiskId - _string_ (Optional) The ID of the RAM disk with which to launch the instance. Some kernels require additional drivers at launch. Check the kernel requirements for information on whether you need to specify a RAM disk. To find kernel requirements, go to the Resource Center and search for the kernel ID.
	 *	BlockDeviceMapping - _ComplexList_ (Optional)  A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `BlockDeviceMapping` subtype (documented next), or by passing a nested associative array with the following `BlockDeviceMapping`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	BlockDeviceMapping.x.VirtualName - _string_ (Optional) Specifies the virtual device name.
	 *	BlockDeviceMapping.x.DeviceName - _string_ (Optional) Specifies the device name (e.g., /dev/sdh).
	 *	BlockDeviceMapping.x.Ebs.SnapshotId - _string_ (Optional) The ID of the snapshot from which the volume will be created.
	 *	BlockDeviceMapping.x.Ebs.VolumeSize - _integer_ (Optional) The size of the volume, in gigabytes.
	 *	BlockDeviceMapping.x.Ebs.DeleteOnTermination - _boolean_ (Optional) Specifies whether the Amazon EBS volume is deleted on instance termination.
	 *	BlockDeviceMapping.x.NoDevice - _string_ (Optional) Specifies the device name to suppress during instance launch.
	 *	Monitoring.Enabled - _boolean_ (Optional) Enables monitoring for the instance.
	 *	SubnetId - _string_ (Optional) Specifies the subnet ID within which to launch the instance(s) for Amazon Virtual Private Cloud.
	 *	DisableApiTermination - _boolean_ (Optional) Specifies whether the instance can be terminated using the APIs. You must modify this attribute before you can terminate any "locked" instances from the APIs.
	 *	InstanceInitiatedShutdownBehavior - _string_ (Optional) Specifies whether the instance's Amazon EBS volumes are stopped or terminated when the instance is shut down.
	 *	License - _ComplexType_ (Optional) Specifies active licenses in use and attached to an Amazon EC2 instance. A ComplexType can be set two ways: by setting each individual `License` subtype (documented next), or by passing a nested associative array with the following `License`-prefixed entries as keys.
	 *	License.Pool - _string_ (Optional) The license pool from which to take a license when starting Amazon EC2 instances in the associated `RunInstances` request.
	 *	PrivateIpAddress - _string_ (Optional) If you're using Amazon Virtual Private Cloud, you can optionally use this parameter to assign the instance a specific available IP address from the subnet.
	 *	ClientToken - _string_ (Optional)
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function run_instances($image_id, $min_count, $max_count, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageId'] = $image_id;
		$opt['MinCount'] = $min_count;
		$opt['MaxCount'] = $max_count;

		// Optional parameter
		if (isset($opt['SecurityGroup']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'SecurityGroup' => (is_array($opt['SecurityGroup']) ? $opt['SecurityGroup'] : array($opt['SecurityGroup']))
			)));
			unset($opt['SecurityGroup']);
		}

		// Optional parameter
		if (isset($opt['Placement']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Placement' => $opt['Placement'])));
			unset($opt['Placement']);
		}

		// Optional parameter
		if (isset($opt['BlockDeviceMapping']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('BlockDeviceMapping' => $opt['BlockDeviceMapping'])));
			unset($opt['BlockDeviceMapping']);
		}

		// Optional parameter
		if (isset($opt['License']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('License' => $opt['License'])));
			unset($opt['License']);
		}

		return $this->authenticate('RunInstances', $opt, $this->hostname);
	}

	/**
	 * Method: describe_reserved_instances()
	 * 	The DescribeReservedInstances operation describes Reserved Instances that were purchased for use
	 * 	with your account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	ReservedInstancesId - _string_|_array_ (Optional) The optional list of Reserved Instance IDs to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified ReservedInstances. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_reserved_instances($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['ReservedInstancesId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ReservedInstancesId' => (is_array($opt['ReservedInstancesId']) ? $opt['ReservedInstancesId'] : array($opt['ReservedInstancesId']))
			)));
			unset($opt['ReservedInstancesId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeReservedInstances', $opt, $this->hostname);
	}

	/**
	 * Method: describe_availability_zones()
	 * 	The DescribeAvailabilityZones operation describes availability zones that are currently available to
	 * 	the account and their states.
	 *
	 * 	Availability zones are not the same across accounts. The availability zone us-east-1a for account A
	 * 	is not necessarily the same as us-east-1a for account B. Zone assignments are mapped independently
	 * 	for each account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	ZoneName - _string_|_array_ (Optional) A list of the availability zone names to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified AvailabilityZones. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_availability_zones($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['ZoneName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ZoneName' => (is_array($opt['ZoneName']) ? $opt['ZoneName'] : array($opt['ZoneName']))
			)));
			unset($opt['ZoneName']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeAvailabilityZones', $opt, $this->hostname);
	}

	/**
	 * Method: detach_volume()
	 * 	Detach a previously attached volume from a running instance.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$volume_id - _string_ (Required) The ID of the volume to detach.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	InstanceId - _string_ (Optional) The ID of the instance from which to detach the the specified volume.
	 *	Device - _string_ (Optional) The device name to which the volume is attached on the specified instance.
	 *	Force - _boolean_ (Optional) Forces detachment if the previous detachment attempt did not occur cleanly (logging into an instance, unmounting the volume, and detaching normally). This option can lead to data loss or a corrupted file system. Use this option only as a last resort to detach a volume from a failed instance. The instance will not have an opportunity to flush file system caches nor file system meta data. If you use this option, you must perform file system check and repair procedures.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function detach_volume($volume_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['VolumeId'] = $volume_id;

		return $this->authenticate('DetachVolume', $opt, $this->hostname);
	}

	/**
	 * Method: delete_key_pair()
	 * 	The DeleteKeyPair operation deletes a key pair.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$key_name - _string_ (Required) The name of the Amazon EC2 key pair to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_key_pair($key_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['KeyName'] = $key_name;

		return $this->authenticate('DeleteKeyPair', $opt, $this->hostname);
	}

	/**
	 * Method: describe_instances()
	 * 	The DescribeInstances operation returns information about instances that you own.
	 *
	 * 	If you specify one or more instance IDs, Amazon EC2 returns information for those instances. If you
	 * 	do not specify instance IDs, Amazon EC2 returns information for all relevant instances. If you
	 * 	specify an invalid instance ID, a fault is returned. If you specify an instance that you do not own,
	 * 	it will not be included in the returned results.
	 *
	 * 	Recently terminated instances might appear in the returned results. This interval is usually less
	 * 	than one hour.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	InstanceId - _string_|_array_ (Optional) An optional list of the instances to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Instances. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_instances($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['InstanceId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'InstanceId' => (is_array($opt['InstanceId']) ? $opt['InstanceId'] : array($opt['InstanceId']))
			)));
			unset($opt['InstanceId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeInstances', $opt, $this->hostname);
	}

	/**
	 * Method: describe_images()
	 * 	The DescribeImages operation returns information about AMIs, AKIs, and ARIs available to the user.
	 * 	Information returned includes image type, product codes, architecture, and kernel and RAM disk IDs.
	 * 	Images available to the user include public images available for any user to launch, private images
	 * 	owned by the user making the request, and private images owned by other users for which the user has
	 * 	explicit launch permissions.
	 *
	 * 	Launch permissions fall into three categories:
	 *
	 * 	- Public: The owner of the AMI granted launch permissions for the AMI to the all group. All users
	 * 	have launch permissions for these AMIs.
	 *
	 * 	- Explicit: The owner of the AMI granted launch permissions to a specific user.
	 *
	 * 	- Implicit: A user has implicit launch permissions for all AMIs he or she owns.
	 *
	 * 	The list of AMIs returned can be modified by specifying AMI IDs, AMI owners, or users with launch
	 * 	permissions. If no options are specified, Amazon EC2 returns all AMIs for which the user has launch
	 * 	permissions.
	 *
	 * 	If you specify one or more AMI IDs, only AMIs that have the specified IDs are returned. If you
	 * 	specify an invalid AMI ID, a fault is returned. If you specify an AMI ID for which you do not have
	 * 	access, it will not be included in the returned results.
	 *
	 * 	If you specify one or more AMI owners, only AMIs from the specified owners and for which you have
	 * 	access are returned. The results can include the account IDs of the specified owners, amazon for
	 * 	AMIs owned by Amazon or self for AMIs that you own.
	 *
	 * 	If you specify a list of executable users, only users that have launch permissions for the AMIs are
	 * 	returned. You can specify account IDs (if you own the AMI(s)), self for AMIs for which you own or
	 * 	have explicit permissions, or all for public AMIs.
	 *
	 * 	Deregistered images are included in the returned results for an unspecified interval after
	 * 	deregistration.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	ImageId - _string_|_array_ (Optional) An optional list of the AMI IDs to describe. If not specified, all AMIs will be described. Pass a string for a single value, or an indexed array for multiple values..
	 *	Owner - _string_|_array_ (Optional) The optional list of owners for the described AMIs. The IDs amazon, self, and explicit can be used to include AMIs owned by Amazon, AMIs owned by the user, and AMIs for which the user has explicit launch permissions, respectively. Pass a string for a single value, or an indexed array for multiple values..
	 *	ExecutableBy - _string_|_array_ (Optional) The optional list of users with explicit launch permissions for the described AMIs. The user ID can be a user's account ID, 'self' to return AMIs for which the sender of the request has explicit launch permissions, or 'all' to return AMIs with public launch permissions. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Images. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_images($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['ImageId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ImageId' => (is_array($opt['ImageId']) ? $opt['ImageId'] : array($opt['ImageId']))
			)));
			unset($opt['ImageId']);
		}

		// Optional parameter
		if (isset($opt['Owner']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'Owner' => (is_array($opt['Owner']) ? $opt['Owner'] : array($opt['Owner']))
			)));
			unset($opt['Owner']);
		}

		// Optional parameter
		if (isset($opt['ExecutableBy']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ExecutableBy' => (is_array($opt['ExecutableBy']) ? $opt['ExecutableBy'] : array($opt['ExecutableBy']))
			)));
			unset($opt['ExecutableBy']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeImages', $opt, $this->hostname);
	}

	/**
	 * Method: start_instances()
	 * 	Starts an instance that uses an Amazon EBS volume as its root device. Instances that use Amazon EBS
	 * 	volumes as their root devices can be quickly stopped and started. When an instance is stopped, the
	 * 	compute resources are released and you are not billed for hourly instance usage. However, your root
	 * 	partition Amazon EBS volume remains, continues to persist your data, and you are charged for Amazon
	 * 	EBS volume usage. You can restart your instance at any time.
	 *
	 * 	Before stopping an instance, make sure it is in a state from which it can be restarted. Stopping an
	 * 	instance does not preserve data stored in RAM.
	 *
	 * 	Performing this operation on an instance that uses an instance store as its root device returns an
	 * 	error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of Amazon EC2 instances to start. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function start_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('StartInstances', $opt, $this->hostname);
	}

	/**
	 * Method: unmonitor_instances()
	 * 	Disables monitoring for a running instance.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of Amazon EC2 instances on which to disable monitoring. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function unmonitor_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('UnmonitorInstances', $opt, $this->hostname);
	}

	/**
	 * Method: modify_instance_attribute()
	 * 	Modifies an attribute of an instance.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The ID of the instance whose attribute is being modified.
	 *	$attribute - _string_ (Required) The name of the attribute being modified. Available attribute names: kernel, ramdisk, userData, blockDeviceMapping, disableApiTermination, instanceInitiatedShutdownBehavior
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Value - _string_ (Optional) The new value of the instance attribute being modified. Only valid when kernel, ramdisk, userData disableApiTermination, or instanceInitiateShutdownBehavior is specified as the attribute being modified.
	 *	BlockDeviceMapping - _ComplexList_ (Optional) The new block device mappings for the instance whose attributes are being modified. Only valid when blockDeviceMapping is specified as the attribute being modified. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `BlockDeviceMapping` subtype (documented next), or by passing a nested associative array with the following `BlockDeviceMapping`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	BlockDeviceMapping.x.DeviceName - _string_ (Optional) The device name (e.g., /dev/sdh) at which the block device is exposed on the instance.
	 *	BlockDeviceMapping.x.Ebs.VolumeId - _string_ (Optional) The ID of the EBS volume that should be mounted as a block device on an Amazon EC2 instance.
	 *	BlockDeviceMapping.x.Ebs.DeleteOnTermination - _boolean_ (Optional) Specifies whether the Amazon EBS volume is deleted on instance termination.
	 *	BlockDeviceMapping.x.VirtualName - _string_ (Optional) The virtual device name.
	 *	BlockDeviceMapping.x.NoDevice - _string_ (Optional) When set to the empty string, specifies that the device name in this object should not be mapped to any real device.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function modify_instance_attribute($instance_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['Attribute'] = $attribute;

		// Optional parameter
		if (isset($opt['BlockDeviceMapping']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('BlockDeviceMapping' => $opt['BlockDeviceMapping'])));
			unset($opt['BlockDeviceMapping']);
		}

		return $this->authenticate('ModifyInstanceAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: delete_security_group()
	 * 	The DeleteSecurityGroup operation deletes a security group.
	 *
	 * 	If you attempt to delete a security group that contains instances, a fault is returned.
	 *
	 * 	If you attempt to delete a security group that is referenced by another security group, a fault is
	 * 	returned. For example, if security group B has a rule that allows access from security group A,
	 * 	security group A cannot be deleted until the allow rule is removed.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) The name of the Amazon EC2 security group to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_security_group($group_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;

		return $this->authenticate('DeleteSecurityGroup', $opt, $this->hostname);
	}

	/**
	 * Method: create_image()
	 * 	Creates an AMI that uses an Amazon EBS root device from a "running" or "stopped" instance. AMIs that
	 * 	use an Amazon EBS root device boot faster than AMIs that use instance stores. They can be up to 1
	 * 	TiB in size, use storage that persists on instance failure, and can be stopped and started.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The ID of the instance from which to create the new image.
	 *	$name - _string_ (Required) The name for the new AMI being created.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Description - _string_ (Optional) The description for the new AMI being created.
	 *	NoReboot - _boolean_ (Optional) By default this property is set to `false`, which means Amazon EC2 attempts to cleanly shut down the instance before image creation and reboots the instance afterwards. When set to true, Amazon EC2 will not shut down the instance before creating the image. When this option is used, file system integrity on the created image cannot be guaranteed.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_image($instance_id, $name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['Name'] = $name;

		return $this->authenticate('CreateImage', $opt, $this->hostname);
	}

	/**
	 * Method: authorize_security_group_ingress()
	 * 	The AuthorizeSecurityGroupIngress operation adds permissions to a security group.
	 *
	 * 	Permissions are specified by the IP protocol (TCP, UDP or ICMP), the source of the request (by IP
	 * 	range or an Amazon EC2 user-group pair), the source and destination port ranges (for TCP and UDP),
	 * 	and the ICMP codes and types (for ICMP). When authorizing ICMP, -1 can be used as a wildcard in the
	 * 	type and code fields.
	 *
	 * 	Permission changes are propagated to instances within the security group as quickly as possible.
	 * 	However, depending on the number of instances, a small delay might occur.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) Name of the group to modify. The name must be valid and belong to the account.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	SourceSecurityGroupName - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. Name of the security group. Cannot be used when specifying a CIDR IP address.
	 *	SourceSecurityGroupOwnerId - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. AWS user ID of an account. Cannot be used when specifying a CIDR IP address.
	 *	IpProtocol - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. IP protocol.
	 *	FromPort - _integer_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. Start of port range for the TCP and UDP protocols, or an ICMP type number. An ICMP type number of -1 indicates a wildcard (i.e., any ICMP type number).
	 *	ToPort - _integer_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. End of port range for the TCP and UDP protocols, or an ICMP code. An ICMP code of -1 indicates a wildcard (i.e., any ICMP code).
	 *	CidrIp - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. CIDR range.
	 *	IpPermissions - _ComplexList_ (Optional) List of IP permissions to authorize on the specified security group. Specifying permissions through IP permissions is the preferred way of authorizing permissions since it offers more flexibility and control. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `IpPermissions` subtype (documented next), or by passing a nested associative array with the following `IpPermissions`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	IpPermissions.x.IpProtocol - _string_ (Optional) The IP protocol of this permission. Valid protocol values: tpc, upd, icmp
	 *	IpPermissions.x.FromPort - _integer_ (Optional) Start of port range for the TCP and UDP protocols, or an ICMP type number. An ICMP type number of -1 indicates a wildcard (i.e., any ICMP type number).
	 *	IpPermissions.x.ToPort - _integer_ (Optional) End of port range for the TCP and UDP protocols, or an ICMP code. An ICMP code of -1 indicates a wildcard (i.e., any ICMP code).
	 *	IpPermissions.x.Groups.y.UserId - _string_ (Optional) The AWS user ID of an account.
	 *	IpPermissions.x.Groups.y.GroupName - _string_ (Optional) The name of the security group in the specified user's account.
	 *	IpPermissions.x.IpRanges.y - _string_ (Optional) The list of CIDR IP ranges included in this permission.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function authorize_security_group_ingress($group_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;

		// Optional parameter
		if (isset($opt['IpPermissions']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('IpPermissions' => $opt['IpPermissions'])));
			unset($opt['IpPermissions']);
		}

		return $this->authenticate('AuthorizeSecurityGroupIngress', $opt, $this->hostname);
	}

	/**
	 * Method: describe_spot_instance_requests()
	 *
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	SpotInstanceRequestId - _string_|_array_ (Optional) The ID of the request. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified SpotInstances. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_spot_instance_requests($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['SpotInstanceRequestId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'SpotInstanceRequestId' => (is_array($opt['SpotInstanceRequestId']) ? $opt['SpotInstanceRequestId'] : array($opt['SpotInstanceRequestId']))
			)));
			unset($opt['SpotInstanceRequestId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeSpotInstanceRequests', $opt, $this->hostname);
	}

	/**
	 * Method: get_password_data()
	 * 	Retrieves the encrypted administrator password for the instances running Windows.
	 *
	 * 	The Windows password is only generated the first time an AMI is launched. It is not generated for
	 * 	rebundled AMIs or after the password is changed on an instance. The password is encrypted using the
	 * 	key pair that you provided.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The ID of the instance for which you want the Windows administrator password.
	 *	$opt - _array_ (Optional) An associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	DecryptPasswordWithKey - _string_ (Optional) Enables the decryption of the Administrator password for the given Microsoft Windows instance. Specifies the RSA private key that is associated with the keypair ID which was used to launch the Microsoft Windows instance.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This is useful for manually-managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function get_password_data($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;

		// Unless DecryptPasswordWithKey is set, simply return the response.
		if (!isset($opt['DecryptPasswordWithKey']))
		{
			return $this->authenticate('GetPasswordData', $opt, $this->hostname);
		}

		// Otherwise, decrypt the password.
		else
		{
			// Get a resource representing the private key.
			$private_key = openssl_pkey_get_private($opt['DecryptPasswordWithKey']);
			unset($opt['DecryptPasswordWithKey']);

			// Fetch the encrypted password.
			$response = $this->authenticate('GetPasswordData', $opt, $this->hostname);
			$data = trim((string) $response->body->passwordData);

			// If it's Base64-encoded...
			if ($this->util->is_base64($data))
			{
				// Base64-decode it, and decrypt it with the private key.
				if (openssl_private_decrypt(base64_decode($data), $decrypted, $private_key))
				{
					// Replace the previous password data with the decrypted value.
					$response->body->passwordData = $decrypted;
				}
			}

			return $response;
		}
	}

	/**
	 * Method: stop_instances()
	 * 	Stops an instance that uses an Amazon EBS volume as its root device. Instances that use Amazon EBS
	 * 	volumes as their root devices can be quickly stopped and started. When an instance is stopped, the
	 * 	compute resources are released and you are not billed for hourly instance usage. However, your root
	 * 	partition Amazon EBS volume remains, continues to persist your data, and you are charged for Amazon
	 * 	EBS volume usage. You can restart your instance at any time.
	 *
	 * 	Before stopping an instance, make sure it is in a state from which it can be restarted. Stopping an
	 * 	instance does not preserve data stored in RAM.
	 *
	 * 	Performing this operation on an instance that uses an instance store as its root device returns an
	 * 	error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of Amazon EC2 instances to stop. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Force - _boolean_ (Optional) Forces the instance to stop. The instance will not have an opportunity to flush file system caches nor file system meta data. If you use this option, you must perform file system check and repair procedures. This option is not recommended for Windows instances.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function stop_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('StopInstances', $opt, $this->hostname);
	}

	/**
	 * Method: import_key_pair()
	 * 	Imports the public key from an RSA key pair created with a third-party tool. This operation differs
	 * 	from CreateKeyPair as the private key is never transferred between the caller and AWS servers.
	 *
	 * 	RSA key pairs are easily created on Microsoft Windows and Linux OS systems using the `ssh-keygen`
	 * 	command line tool provided with the standard OpenSSH installation. Standard library support for RSA
	 * 	key pair creation is also available for Java, Ruby, Python, and many other programming languages.
	 *
	 * 	The following formats are supported:
	 *
	 * 	- OpenSSH public key format.
	 *
	 * 	- Base64 encoded DER format.
	 *
	 * 	- SSH public key file format as specified in [RFC4716](http://tools.ietf.org/html/rfc4716).
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$key_name - _string_ (Required) The unique name for the key pair.
	 *	$public_key_material - _string_ (Required) The public key portion of the key pair being imported.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function import_key_pair($key_name, $public_key_material, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['KeyName'] = $key_name;
		$opt['PublicKeyMaterial'] = $this->util->is_base64($public_key_material) ? $public_key_material : base64_encode($public_key_material);

		return $this->authenticate('ImportKeyPair', $opt, $this->hostname);
	}

	/**
	 * Method: describe_spot_price_history()
	 * 	Describes the Spot Price history.
	 *
	 * 	Spot Instances are instances that Amazon EC2 starts on your behalf when the maximum price that you
	 * 	specify exceeds the current Spot Price. Amazon EC2 periodically sets the Spot Price based on
	 * 	available Spot Instance capacity and current spot instance requests.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	StartTime - _string_ (Optional) The start date and time of the Spot Instance price history data. Accepts any value that `strtotime()` understands.
	 *	EndTime - _string_ (Optional) The end date and time of the Spot Instance price history data. Accepts any value that `strtotime()` understands.
	 *	InstanceType - _string_|_array_ (Optional) Specifies the instance type to return. Pass a string for a single value, or an indexed array for multiple values..
	 *	ProductDescription - _string_|_array_ (Optional) The description of the AMI. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified SpotPriceHistory. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_spot_price_history($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['StartTime']))
		{
			$opt['StartTime'] = $this->util->convert_date_to_iso8601($opt['StartTime']);
		}

		// Optional parameter
		if (isset($opt['EndTime']))
		{
			$opt['EndTime'] = $this->util->convert_date_to_iso8601($opt['EndTime']);
		}

		// Optional parameter
		if (isset($opt['InstanceType']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'InstanceType' => (is_array($opt['InstanceType']) ? $opt['InstanceType'] : array($opt['InstanceType']))
			)));
			unset($opt['InstanceType']);
		}

		// Optional parameter
		if (isset($opt['ProductDescription']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ProductDescription' => (is_array($opt['ProductDescription']) ? $opt['ProductDescription'] : array($opt['ProductDescription']))
			)));
			unset($opt['ProductDescription']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeSpotPriceHistory', $opt, $this->hostname);
	}

	/**
	 * Method: create_security_group()
	 * 	The CreateSecurityGroup operation creates a new security group.
	 *
	 * 	Every instance is launched in a security group. If no security group is specified during launch,
	 * 	the instances are launched in the default security group. Instances within the same security group
	 * 	have unrestricted network access to each other. Instances will reject network access attempts from
	 * 	other instances in a different security group. As the owner of instances you can grant or revoke
	 * 	specific permissions using the AuthorizeSecurityGroupIngress and RevokeSecurityGroupIngress
	 * 	operations.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) Name of the security group.
	 *	$group_description - _string_ (Required) Description of the group. This is informational only.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_security_group($group_name, $group_description, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;
		$opt['GroupDescription'] = $group_description;

		return $this->authenticate('CreateSecurityGroup', $opt, $this->hostname);
	}

	/**
	 * Method: describe_regions()
	 * 	The DescribeRegions operation describes regions zones that are currently available to the account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	RegionName - _string_|_array_ (Optional) The optional list of regions to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Regions. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_regions($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['RegionName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'RegionName' => (is_array($opt['RegionName']) ? $opt['RegionName'] : array($opt['RegionName']))
			)));
			unset($opt['RegionName']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeRegions', $opt, $this->hostname);
	}

	/**
	 * Method: reset_snapshot_attribute()
	 * 	Resets permission settings for the specified snapshot.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$snapshot_id - _string_ (Required) The ID of the snapshot whose attribute is being reset.
	 *	$attribute - _string_ (Required) The name of the attribute being reset. Available attribute names: createVolumePermission
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function reset_snapshot_attribute($snapshot_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['SnapshotId'] = $snapshot_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('ResetSnapshotAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: describe_security_groups()
	 * 	The DescribeSecurityGroups operation returns information about security groups that you own.
	 *
	 * 	If you specify security group names, information about those security group is returned. Otherwise,
	 * 	information for all security group is returned. If you specify a group that does not exist, a fault
	 * 	is returned.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	GroupName - _string_|_array_ (Optional) The optional list of Amazon EC2 security groups to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified SecurityGroups. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_security_groups($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['GroupName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'GroupName' => (is_array($opt['GroupName']) ? $opt['GroupName'] : array($opt['GroupName']))
			)));
			unset($opt['GroupName']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeSecurityGroups', $opt, $this->hostname);
	}

	/**
	 * Method: request_spot_instances()
	 * 	Creates a Spot Instance request.
	 *
	 * 	Spot Instances are instances that Amazon EC2 starts on your behalf when the maximum price that you
	 * 	specify exceeds the current Spot Price. Amazon EC2 periodically sets the Spot Price based on
	 * 	available Spot Instance capacity and current spot instance requests.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$spot_price - _string_ (Required) Specifies the maximum hourly price for any Spot Instance launched to fulfill the request.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	InstanceCount - _integer_ (Optional) Specifies the maximum number of Spot Instances to launch.
	 *	Type - _string_ (Optional) Specifies the Spot Instance type. [Allowed values: `one-time`, `persistent`]
	 *	ValidFrom - _string_ (Optional) Defines the start date of the request. If this is a one-time request, the request becomes active at this date and time and remains active until all instances launch, the request expires, or the request is canceled. If the request is persistent, the request becomes active at this date and time and remains active until it expires or is canceled. Accepts any value that `strtotime()` understands.
	 *	ValidUntil - _string_ (Optional) End date of the request. If this is a one-time request, the request remains active until all instances launch, the request is canceled, or this date is reached. If the request is persistent, it remains active until it is canceled or this date and time is reached. Accepts any value that `strtotime()` understands.
	 *	LaunchGroup - _string_ (Optional) Specifies the instance launch group. Launch groups are Spot Instances that launch and terminate together.
	 *	AvailabilityZoneGroup - _string_ (Optional) Specifies the Availability Zone group. When specifying the same Availability Zone group for all Spot Instance requests, all Spot Instances are launched in the same Availability Zone.
	 *	LaunchSpecification - _ComplexType_ (Optional) Specifies additional launch instance information. A ComplexType can be set two ways: by setting each individual `LaunchSpecification` subtype (documented next), or by passing a nested associative array with the following `LaunchSpecification`-prefixed entries as keys.
	 *	LaunchSpecification.ImageId - _string_ (Optional) The AMI ID.
	 *	LaunchSpecification.KeyName - _string_ (Optional) The name of the key pair.
	 *	LaunchSpecification.SecurityGroup.x - _string_ (Optional)
	 *	LaunchSpecification.UserData - _string_ (Optional) Optional data, specific to a user's application, to provide in the launch request. All instances that collectively comprise the launch request have access to this data. User data is never returned through API responses.
	 *	LaunchSpecification.AddressingType - _string_ (Optional) Deprecated.
	 *	LaunchSpecification.InstanceType - _string_ (Optional) Specifies the instance type. [Allowed values: `t1.micro`, `m1.small`, `m1.large`, `m1.xlarge`, `m2.xlarge`, `m2.2xlarge`, `m2.4xlarge`, `c1.medium`, `c1.xlarge`, `cc1.4xlarge`]
	 *	LaunchSpecification.Placement.AvailabilityZone - _string_ (Optional) The availability zone in which an Amazon EC2 instance runs.
	 *	LaunchSpecification.Placement.GroupName - _string_ (Optional) The name of a PlacementGroup.
	 *	LaunchSpecification.KernelId - _string_ (Optional) Specifies the ID of the kernel to select.
	 *	LaunchSpecification.RamdiskId - _string_ (Optional) Specifies the ID of the RAM disk to select. Some kernels require additional drivers at launch. Check the kernel requirements for information on whether or not you need to specify a RAM disk and search for the kernel ID.
	 *	LaunchSpecification.BlockDeviceMapping.x.VirtualName - _string_ (Optional) Specifies the virtual device name.
	 *	LaunchSpecification.BlockDeviceMapping.x.DeviceName - _string_ (Optional) Specifies the device name (e.g., /dev/sdh).
	 *	LaunchSpecification.BlockDeviceMapping.x.Ebs.SnapshotId - _string_ (Optional) The ID of the snapshot from which the volume will be created.
	 *	LaunchSpecification.BlockDeviceMapping.x.Ebs.VolumeSize - _integer_ (Optional) The size of the volume, in gigabytes.
	 *	LaunchSpecification.BlockDeviceMapping.x.Ebs.DeleteOnTermination - _boolean_ (Optional) Specifies whether the Amazon EBS volume is deleted on instance termination.
	 *	LaunchSpecification.BlockDeviceMapping.x.NoDevice - _string_ (Optional) Specifies the device name to suppress during instance launch.
	 *	LaunchSpecification.Monitoring.Enabled - _boolean_ (Optional)
	 *	LaunchSpecification.SubnetId - _string_ (Optional) Specifies the Amazon VPC subnet ID within which to launch the instance(s) for Amazon Virtual Private Cloud.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function request_spot_instances($spot_price, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['SpotPrice'] = $spot_price;

		// Optional parameter
		if (isset($opt['ValidFrom']))
		{
			$opt['ValidFrom'] = $this->util->convert_date_to_iso8601($opt['ValidFrom']);
		}

		// Optional parameter
		if (isset($opt['ValidUntil']))
		{
			$opt['ValidUntil'] = $this->util->convert_date_to_iso8601($opt['ValidUntil']);
		}

		// Optional parameter
		if (isset($opt['LaunchSpecification']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('LaunchSpecification' => $opt['LaunchSpecification'])));
			unset($opt['LaunchSpecification']);
		}

		return $this->authenticate('RequestSpotInstances', $opt, $this->hostname);
	}

	/**
	 * Method: create_tags()
	 * 	Adds or overwrites tags for the specified resources. Each resource can have a maximum of 10 tags.
	 * 	Each tag consists of a key-value pair. Tag keys must be unique per resource.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$resource_id - _string_|_array_ (Required) One or more IDs of resources to tag. This could be the ID of an AMI, an instance, an EBS volume, or snapshot, etc. Pass a string for a single value, or an indexed array for multiple values..
	 *	$tag - _ComplexList_ (Required) The tags to add or overwrite for the specified resources. Each tag item consists of a key-value pair. A **required** ComplexList is an indexed array of ComplexTypes -- each of which must be set by passing a nested associative array with the following `Tag`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $tag parameter:
	 *	Key - _string_ (Optional) The tag's key.
	 *	Value - _string_ (Optional) The tag's value.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_tags($resource_id, $tag, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'ResourceId' => (is_array($resource_id) ? $resource_id : array($resource_id))
		)));

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Tag' => (is_array($tag) ? $tag : array($tag))
		)));

		return $this->authenticate('CreateTags', $opt, $this->hostname);
	}

	/**
	 * Method: deregister_image()
	 * 	The DeregisterImage operation deregisters an AMI. Once deregistered, instances of the AMI can no
	 * 	longer be launched.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_id - _string_ (Required) The ID of the AMI to deregister.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function deregister_image($image_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageId'] = $image_id;

		return $this->authenticate('DeregisterImage', $opt, $this->hostname);
	}

	/**
	 * Method: describe_spot_datafeed_subscription()
	 * 	Describes the data feed for Spot Instances.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_spot_datafeed_subscription($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeSpotDatafeedSubscription', $opt, $this->hostname);
	}

	/**
	 * Method: delete_tags()
	 * 	Deletes tags from the specified Amazon EC2 resources.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$resource_id - _string_|_array_ (Required) A list of one or more resource IDs. This could be the ID of an AMI, an instance, an EBS volume, or snapshot, etc. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Tag - _ComplexList_ (Optional) The tags to delete from the specified resources. Each tag item consists of a key-value pair. If a tag is specified without a value, the tag and all of its values are deleted. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Tag` subtype (documented next), or by passing a nested associative array with the following `Tag`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Tag.x.Key - _string_ (Optional) The tag's key.
	 *	Tag.x.Value - _string_ (Optional) The tag's value.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_tags($resource_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'ResourceId' => (is_array($resource_id) ? $resource_id : array($resource_id))
		)));

		// Optional parameter
		if (isset($opt['Tag']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Tag' => $opt['Tag'])));
			unset($opt['Tag']);
		}

		return $this->authenticate('DeleteTags', $opt, $this->hostname);
	}

	/**
	 * Method: describe_tags()
	 * 	Describes the tags for the specified resources.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified tags. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_tags($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeTags', $opt, $this->hostname);
	}

	/**
	 * Method: cancel_bundle_task()
	 * 	CancelBundleTask operation cancels a pending or in-progress bundling task. This is an asynchronous
	 * 	call and it make take a while for the task to be canceled. If a task is canceled while it is storing
	 * 	items, there may be parts of the incomplete AMI stored in S3. It is up to the caller to clean up
	 * 	these parts from S3.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$bundle_id - _string_ (Required) The ID of the bundle task to cancel.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function cancel_bundle_task($bundle_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['BundleId'] = $bundle_id;

		return $this->authenticate('CancelBundleTask', $opt, $this->hostname);
	}

	/**
	 * Method: cancel_spot_instance_requests()
	 * 	Cancels one or more Spot Instance requests.
	 *
	 * 	Spot Instances are instances that Amazon EC2 starts on your behalf when the maximum price that you
	 * 	specify exceeds the current Spot Price. Amazon EC2 periodically sets the Spot Price based on
	 * 	available Spot Instance capacity and current spot instance requests.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$spot_instance_request_id - _string_|_array_ (Required) Specifies the ID of the Spot Instance request. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function cancel_spot_instance_requests($spot_instance_request_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'SpotInstanceRequestId' => (is_array($spot_instance_request_id) ? $spot_instance_request_id : array($spot_instance_request_id))
		)));

		return $this->authenticate('CancelSpotInstanceRequests', $opt, $this->hostname);
	}

	/**
	 * Method: attach_volume()
	 * 	Attach a previously created volume to a running instance.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$volume_id - _string_ (Required) The ID of the Amazon EBS volume. The volume and instance must be within the same Availability Zone and the instance must be running.
	 *	$instance_id - _string_ (Required) The ID of the instance to which the volume attaches. The volume and instance must be within the same Availability Zone and the instance must be running.
	 *	$device - _string_ (Required) Specifies how the device is exposed to the instance (e.g., /dev/sdh).
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function attach_volume($volume_id, $instance_id, $device, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['VolumeId'] = $volume_id;
		$opt['InstanceId'] = $instance_id;
		$opt['Device'] = $device;

		return $this->authenticate('AttachVolume', $opt, $this->hostname);
	}

	/**
	 * Method: describe_licenses()
	 * 	Provides details of a user's registered licenses. Zero or more IDs may be specified on the call.
	 * 	When one or more license IDs are specified, only data for the specified IDs are returned.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	LicenseId - _string_|_array_ (Optional) Specifies the license registration for which details are to be returned. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Licenses. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_licenses($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['LicenseId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'LicenseId' => (is_array($opt['LicenseId']) ? $opt['LicenseId'] : array($opt['LicenseId']))
			)));
			unset($opt['LicenseId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeLicenses', $opt, $this->hostname);
	}

	/**
	 * Method: purchase_reserved_instances_offering()
	 * 	The PurchaseReservedInstancesOffering operation purchases a Reserved Instance for use with your
	 * 	account. With Amazon EC2 Reserved Instances, you purchase the right to launch Amazon EC2 instances
	 * 	for a period of time (without getting insufficient capacity errors) and pay a lower usage rate for
	 * 	the actual time used.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$reserved_instances_offering_id - _string_ (Required) The unique ID of the Reserved Instances offering being purchased.
	 *	$instance_count - _integer_ (Required) The number of Reserved Instances to purchase.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function purchase_reserved_instances_offering($reserved_instances_offering_id, $instance_count, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ReservedInstancesOfferingId'] = $reserved_instances_offering_id;
		$opt['InstanceCount'] = $instance_count;

		return $this->authenticate('PurchaseReservedInstancesOffering', $opt, $this->hostname);
	}

	/**
	 * Method: activate_license()
	 * 	Activates a specific number of licenses for a 90-day period. Activations can be done against a
	 * 	specific license ID.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$license_id - _string_ (Required) Specifies the ID for the specific license to activate against.
	 *	$capacity - _integer_ (Required) Specifies the additional number of licenses to activate.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function activate_license($license_id, $capacity, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LicenseId'] = $license_id;
		$opt['Capacity'] = $capacity;

		return $this->authenticate('ActivateLicense', $opt, $this->hostname);
	}

	/**
	 * Method: reset_image_attribute()
	 * 	The ResetImageAttribute operation resets an attribute of an AMI to its default value.
	 *
	 * 	The productCodes attribute cannot be reset.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_id - _string_ (Required) The ID of the AMI whose attribute is being reset.
	 *	$attribute - _string_ (Required) The name of the attribute being reset. Available attribute names: launchPermission
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function reset_image_attribute($image_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageId'] = $image_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('ResetImageAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: create_snapshot()
	 * 	Create a snapshot of the volume identified by volume ID. A volume does not have to be detached at
	 * 	the time the snapshot is taken.
	 *
	 * 	Snapshot creation requires that the system is in a consistent state. For instance, this means that
	 * 	if taking a snapshot of a database, the tables must be read-only locked to ensure that the snapshot
	 * 	will not contain a corrupted version of the database. Therefore, be careful when using this API to
	 * 	ensure that the system remains in the consistent state until the create snapshot status has
	 * 	returned.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$volume_id - _string_ (Required) The ID of the volume from which to create the snapshot.
	 *	$description - _string_ (Required) The description for the new snapshot.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_snapshot($volume_id, $description, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['VolumeId'] = $volume_id;
		$opt['Description'] = $description;
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb

		return $this->authenticate('CreateSnapshot', $opt, $this->hostname);
	}

	/**
<<<<<<< HEAD
	 * Method: describe_snapshots()
	 * 	Describes the status of Amazon EBS snapshots.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	SnapshotId.n - _string_ (Optional) The ID of the Amazon EBS snapshot.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeSnapshots.html
	 * 	Related - <create_snapshot()>, <delete_snapshot()>
	 */
	public function describe_snapshots($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeSnapshots', $opt, $this->hostname);
	}

	/**
	 * Method: delete_snapshot()
	 * 	Deletes a snapshot of an Amazon EBS volume that is stored in Amazon S3.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	snapshot_id - _string_ (Optional) The ID of the Amazon EBS snapshot to delete.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DeleteSnapshot.html
	 * 	Related - <create_snapshot()>, <describe_snapshots()>
	 */
	public function delete_snapshot($snapshot_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['SnapshotId'] = $snapshot_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DeleteSnapshot', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// EBS VOLUMES

	/**
	 * Method: create_volume()
	 * 	Creates a new Amazon EBS volume that you can mount from any Amazon EC2 instance. You must specify an availability zone when creating a volume. The volume and any instance to which it attaches must be in the same availability zone.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	sizesnapid - _mixed_ (Required) Either the size of the volume in GB as an integer (from 1 to 1024), or the ID of the snapshot from which to create the new volume as a string.
	 * 	zone - _string_ (Required) The availability zone in which to create the new volume.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-CreateVolume.html
	 * 	Related - <describe_volumes()>, <attach_volume()>, <detach_volume()>, <delete_volume()>
	 */
	public function create_volume($sizesnapid, $zone, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['AvailabilityZone'] = $zone;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		if (is_numeric($sizesnapid))
		{
			$opt['Size'] = $sizesnapid;
		}
		else
		{
			$opt['SnapshotId'] = $sizesnapid;
		}

		return $this->authenticate('CreateVolume', $opt, $this->hostname);
	}

	/**
	 * Method: describe_volumes()
	 * 	Lists one or more Amazon EBS volumes that you own. If you do not specify any volumes, Amazon EBS returns all volumes that you own.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	VolumeId.n - _string_ (Optional) The ID of the volume to list.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeVolumes.html
	 * 	Related - <create_volume()>, <attach_volume()>, <detach_volume()>, <delete_volume()>
	 */
	public function describe_volumes($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeVolumes', $opt, $this->hostname);
	}

	/**
	 * Method: attach_volume()
	 * 	Attaches an Amazon EBS volume to an instance.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	volume_id - _string_ (Required) The ID of the Amazon EBS volume.
	 * 	instance_id - _string_ (Required) The ID of the instance to which the volume attaches.
	 * 	device - _string_ (Required) Specifies how the device is exposed to the instance (e.g., /dev/sdh). For information on standard storage locations, see Storage Locations.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-AttachVolume.html
	 * 	Storage Locations - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/instance-storage.html#storage-locations
	 * 	Related - <create_volume()>, <describe_volumes()>, <detach_volume()>, <delete_volume()>
	 */
	public function attach_volume($volume_id, $instance_id, $device, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['VolumeId'] = $volume_id;
		$opt['InstanceId'] = $instance_id;
		$opt['Device'] = $device;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('AttachVolume', $opt, $this->hostname);
	}

	/**
	 * Method: detach_volume()
	 * 	Detaches an Amazon EBS volume from an instance.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	volume_id - _string_ (Required) The ID of the Amazon EBS volume.
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	InstanceId - _string_ (Optional) The ID of the instance from which the volume will detach.
	 * 	Device - _string_ (Optional) The name of the device.
	 * 	Force - _boolean_ (Optional) Forces detachment if the previous detachment attempt did not occur cleanly (logging into an instance, unmounting the volume, and detaching normally). This option can lead to data loss or a corrupted file system. Use this option only as a last resort to detach an instance from a failed instance. The instance will not have an opportunity to flush file system caches nor file system meta data. If you use this option, you must perform file system check and repair procedures.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DetachVolume.html
	 * 	Related - <create_volume()>, <describe_volumes()>, <attach_volume()>, <delete_volume()>
	 */
	public function detach_volume($volume_id, $opt = null)
	{
		if (!$opt) $opt = array();

		$opt['VolumeId'] = $volume_id;

		return $this->authenticate('DetachVolume', $opt, $this->hostname);
	}

	/**
	 * Method: delete_volume()
	 * 	Deletes an Amazon EBS volume.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	volume_id - _string_ (Required) The ID of the Amazon EBS volume.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DeleteVolume.html
	 * 	Related - <create_volume()>, <describe_volumes()>, <attach_volume()>, <detach_volume()>
	 */
	public function delete_volume($volume_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['VolumeId'] = $volume_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DeleteVolume', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// MISCELLANEOUS

	/**
	 * Method: get_console_output()
	 * 	Retrieves console output for the specified instance. Instance console output is buffered and posted shortly after instance boot, reboot, and termination. Amazon EC2 preserves the most recent 64 KB output which will be available for at least one hour after the most recent post.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	instance_id - _string_ (Required) An instance ID returned from a previous call to <run_instances()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-GetConsoleOutput.html
	 * 	Related - <reboot_instances()>
	 */
	public function get_console_output($instance_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('GetConsoleOutput', $opt, $this->hostname);
	}

	/**
	 * Method: reboot_instances()
	 * 	Requests a reboot of one or more instances. This operation is asynchronous; it only queues a request to reboot the specified instance(s). The operation will succeed if the instances are valid and belong to the user. Requests to reboot terminated instances are ignored.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	InstanceId.1 - _string_ (Required) One instance ID returned from previous calls to <run_instances()>.
	 * 	InstanceId.n - _string_ (Optional) More than one instance IDs returned from previous calls to <run_instances()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-RebootInstances.html
	 * 	Related - <get_console_output()>
	 */
	public function reboot_instances($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('RebootInstances', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// IMAGES

	/**
	 * Method: deregister_image()
	 * 	De-registers an AMI. Once de-registered, instances of the AMI may no longer be launched.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	image_id - _string_ (Required) Unique ID of a machine image, returned by a call to <register_image()> or <describe_images()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DeregisterImage.html
	 * 	Related - <describe_images()>, <register_image()>
	 */
	public function deregister_image($image_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ImageId'] = $image_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DeregisterImage', $opt, $this->hostname);
	}

	/**
	 * Method: describe_images()
	 * 	The DescribeImages operation returns information about AMIs, AKIs, and ARIs available to the user. Information returned includes image type, product codes, architecture, and kernel and RAM disk IDs. Images available to the user include public images available for any user to launch, private images owned by the user making the request, and private images owned by other users for which the user has explicit launch permissions.
	 *
	 * 	Launch permissions fall into three categories: (a) 'public' where the owner of the AMI granted launch permissions for the AMI to the all group. All users have launch permissions for these AMIs. (b) 'explicit' where the owner of the AMI granted launch permissions to a specific user. (c) 'implicit' where a user has implicit launch permissions for all AMIs he or she owns.
	 *
	 * 	The list of AMIs returned can be modified by specifying AMI IDs, AMI owners, or users with launch permissions. If no options are specified, Amazon EC2 returns all AMIs for which the user has launch permissions.
	 *
	 * 	If you specify one or more AMI IDs, only AMIs that have the specified IDs are returned. If you specify an invalid AMI ID, a fault is returned. If you specify an AMI ID for which you do not have access, it will not be included in the returned results.
	 *
	 * 	If you specify one or more AMI owners, only AMIs from the specified owners and for which you have access are returned. The results can include the account IDs of the specified owners, amazon for AMIs owned by Amazon or self for AMIs that you own.
	 *
	 * 	If you specify a list of executable users, only users that have launch permissions for the AMIs are returned. You can specify account IDs (if you own the AMI(s)), self for AMIs for which you own or have explicit permissions, or all for public AMIs.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
 	 * 	ExecutableBy.n - _string_ (Optional) Describe AMIs that the specified users have launch permissions for. Accepts Amazon account ID, 'self', or 'all' for public AMIs.
	 * 	ImageId.n - _string_ (Optional) A list of image descriptions.
	 * 	Owner.n - _string_ (Optional) Owners of AMIs to describe.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeImages.html
	 * 	Related - <deregister_image()>, <register_image()>
	 */
	public function describe_images($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeImages', $opt, $this->hostname);
	}

	/**
	 * Method: register_image()
	 * 	Registers an AMI with Amazon EC2. Images must be registered before they can be launched. For more information, see <run_instances()>.
	 *
	 * 	Each AMI is associated with an unique ID which is provided by the Amazon EC2 service through the <register_image()> operation. During registration, Amazon EC2 retrieves the specified image manifest from Amazon S3 and verifies that the image is owned by the user registering the image.
	 *
	 * 	The image manifest is retrieved once and stored within the Amazon EC2. Any modifications to an image in Amazon S3 invalidates this registration. If you make changes to an image, deregister the previous image and register the new image. For more information, see <deregister_image()>.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	image_location - _string_ (Required) Full path to your AMI manifest in Amazon S3 storage (i.e. mybucket/myimage.manifest.xml).
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-RegisterImage.html
	 * 	Related - <deregister_image()>, <describe_images()>
	 */
	public function register_image($image_location, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ImageLocation'] = $image_location;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('RegisterImage', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// IMAGE ATTRIBUTES

	/**
	 * Method: describe_image_attribute()
	 * 	Returns information about an attribute of an AMI. Only one attribute may be specified per call.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	image_id - _string_ (Required) ID of the AMI for which an attribute will be described, returned by a call to <register_image()> or <describe_images()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeImageAttribute.html
	 * 	Related - <modify_image_attribute()>, <reset_image_attribute()>
	 */
	public function describe_image_attribute($image_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ImageId'] = $image_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		// This is the only supported value in the current release.
		$opt['Attribute'] = 'launchPermission';

		return $this->authenticate('DescribeImageAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: modify_image_attribute()
	 * 	Modifies an attribute of an AMI.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	image_id - _string_ (Required) AMI ID to modify an attribute on.
	 * 	attribute - _string_ (Required) Specifies the attribute to modify. Supports 'launchPermission' and 'productCodes'.
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
 	 * 	OperationType - _string_ (Required for 'launchPermission' Attribute) Specifies the operation to perform on the attribute. Supports 'add' and 'remove'.
 	 * 	UserId.n - _string_ (Required for 'launchPermission' Attribute) User IDs to add to or remove from the 'launchPermission' attribute.
 	 * 	UserGroup.n - _string_ (Required for 'launchPermission' Attribute) User groups to add to or remove from the 'launchPermission' attribute. Currently, only the 'all' group is available, specifiying all Amazon EC2 users.
 	 * 	ProductCode.n - _string_ (Required for 'productCodes' Attribute) Attaches product codes to the AMI. Currently only one product code may be associated with an AMI. Once set, the product code can not be changed or reset.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-ModifyImageAttribute.html
	 * 	Related - <describe_image_attribute()>, <reset_image_attribute()>
	 */
	public function modify_image_attribute($image_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();

		$opt['ImageId'] = $image_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('ModifyImageAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: reset_image_attribute()
	 * 	Resets an attribute of an AMI to its default value (the productCodes attribute cannot be reset).
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	image_id - _string_ (Required) ID of the AMI for which an attribute will be described, returned by a call to <register_image()> or <describe_images()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-ResetImageAttribute.html
	 * 	Related - <describe_image_attribute()>, <modify_image_attribute()>
	 */
	public function reset_image_attribute($image_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ImageId'] = $image_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		// This is the only supported value in the current release.
		$opt['Attribute'] = 'launchPermission';

		return $this->authenticate('ResetImageAttribute', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// INSTANCES

	/**
	 * Method: confirm_product_instance()
	 * 	Returns true if the given product code is attached to the instance with the given instance ID. The operation returns false if the product code is not attached to the instance.
	 *
	 * 	Can only be executed by the owner of the AMI. This feature is useful when an AMI owner is providing support and wants to verify whether a user's instance is eligible.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	product_code - _string_ (Required) The product code to confirm is attached to the instance.
	 * 	instance_id - _string_ (Required) The instance for which to confirm the product code.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-ConfirmProductInstance.html
	 * 	Related - <describe_instances()>, <run_instances()>, <terminate_instances()>
	 */
	public function confirm_product_instance($product_code, $instance_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ProductCode'] = $product_code;
		$opt['InstanceId'] = $instance_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('ConfirmProductInstance', $opt, $this->hostname);
	}

	/**
	 * Method: describe_instances()
	 * 	Returns information about instances owned by the user making the request.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	InstanceId.n - _string_ (Required) Set of instances IDs to get the status of.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeInstances.html
	 * 	Related - <confirm_product_instance()>, <run_instances()>, <terminate_instances()>
	 */
	public function describe_instances($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeInstances', $opt, $this->hostname);
	}

	/**
	 * Method: run_instances()
	 * 	The RunInstances operation launches a specified number of instances. The Query version of <run_instances()> only allows instances of a single AMI to be launched in one call. This is different from the SOAP API version of the call, but similar to the ec2-run-instances command line tool.
	 *
	 * 	If Amazon EC2 cannot launch the minimum number AMIs you request, no instances launch. If there is insufficient capacity to launch the maximum number of AMIs you request, Amazon EC2 launches as many as possible to satisfy the requested maximum values.
	 *
	 * 	Every instance is launched in a security group. If you do not specify a security group at launch, the instances start in your default security group. For more information on creating security groups, see <create_security_group()>.
	 *
	 * 	You can provide an optional key pair ID for each image in the launch request (for more information, see <create_key_pair()>). All instances that are created from images that use this key pair will have access to the associated public key at boot. You can use this key to provide secure access to an instance of an image on a per-instance basis. Amazon EC2 public images use this feature to provide secure access without passwords. IMPORTANT: Launching public images without a key pair ID will leave them inaccessible.
	 *
	 * 	The public key material is made available to the instance at boot time by placing it in the openssh_id.pub file on a logical device that is exposed to the instance as /dev/sda2 (the instance store). The format of this file is suitable for use as an entry within ~/.ssh/authorized_keys (the OpenSSH format). This can be done at boot (e.g., as part of rc.local) allowing for secure access without passwords.
	 *
	 * 	Optional user data can be provided in the launch request. All instances that collectively comprise the launch request have access to this data For more information, see Instance Metadata. NOTE: If any of the AMIs have a product code attached for which the user has not subscribed, the <run_instances()> call will fail.
	 *
	 * 	IMPORTANT: We strongly recommend using the 2.6.18 Xen stock kernel with the c1.medium and c1.xlarge instances. Although the default Amazon EC2 kernels will work, the new kernels provide greater stability and performance for these instance types. For more information about kernels, see Kernels, RAM Disks, and Block Device Mappings.
=======
	 * Method: delete_volume()
	 * 	Deletes a previously created volume. Once successfully deleted, a new volume can be created with the
	 * 	same name.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$volume_id - _string_ (Required) The ID of the EBS volume to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_volume($volume_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['VolumeId'] = $volume_id;

		return $this->authenticate('DeleteVolume', $opt, $this->hostname);
	}

	/**
	 * Method: modify_snapshot_attribute()
	 * 	Adds or remove permission settings for the specified snapshot.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$snapshot_id - _string_ (Required) The ID of the EBS snapshot whose attributes are being modified.
	 *	$attribute - _string_ (Required) The name of the attribute being modified. Available attribute names: createVolumePermission
	 *	$operation_type - _string_ (Required) The operation to perform on the attribute. Available operation names: add, remove
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	UserId - _string_|_array_ (Optional) The AWS user IDs to add to or remove from the list of users that have permission to create EBS volumes from the specified snapshot. Currently supports "all". Only valid when the createVolumePermission attribute is being modified. Pass a string for a single value, or an indexed array for multiple values..
	 *	UserGroup - _string_|_array_ (Optional) The AWS group names to add to or remove from the list of groups that have permission to create EBS volumes from the specified snapshot. Currently supports "all". Only valid when the `createVolumePermission` attribute is being modified. Pass a string for a single value, or an indexed array for multiple values..
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function modify_snapshot_attribute($snapshot_id, $attribute, $operation_type, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['SnapshotId'] = $snapshot_id;
		$opt['Attribute'] = $attribute;
		$opt['OperationType'] = $operation_type;

		// Optional parameter
		if (isset($opt['UserId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'UserId' => (is_array($opt['UserId']) ? $opt['UserId'] : array($opt['UserId']))
			)));
			unset($opt['UserId']);
		}

		// Optional parameter
		if (isset($opt['UserGroup']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'UserGroup' => (is_array($opt['UserGroup']) ? $opt['UserGroup'] : array($opt['UserGroup']))
			)));
			unset($opt['UserGroup']);
		}

		return $this->authenticate('ModifySnapshotAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: terminate_instances()
	 * 	The TerminateInstances operation shuts down one or more instances. This operation is idempotent; if
	 * 	you terminate an instance more than once, each call will succeed.
	 *
	 * 	Terminated instances will remain visible after termination (approximately one hour).
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of instances to terminate. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function terminate_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('TerminateInstances', $opt, $this->hostname);
	}

	/**
	 * Method: delete_spot_datafeed_subscription()
	 * 	Deletes the data feed for Spot Instances.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_spot_datafeed_subscription($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DeleteSpotDatafeedSubscription', $opt, $this->hostname);
	}

	/**
	 * Method: associate_address()
	 * 	The AssociateAddress operation associates an elastic IP address with an instance.
	 *
	 * 	If the IP address is currently assigned to another instance, the IP address is assigned to the new
	 * 	instance. This is an idempotent operation. If you enter it more than once, Amazon EC2 does not
	 * 	return an error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The instance to associate with the IP address.
	 *	$public_ip - _string_ (Required) IP address that you are assigning to the instance.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function associate_address($instance_id, $public_ip, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['PublicIp'] = $public_ip;

		return $this->authenticate('AssociateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: deactivate_license()
	 * 	Deactivates a specific number of licenses. Deactivations can be done against a specific license ID
	 * 	after they have persisted for at least a 90-day period.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$license_id - _string_ (Required) Specifies the ID for the specific license to deactivate against.
	 *	$capacity - _integer_ (Required) Specifies the amount of capacity to deactivate against the license.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function deactivate_license($license_id, $capacity, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['LicenseId'] = $license_id;
		$opt['Capacity'] = $capacity;

		return $this->authenticate('DeactivateLicense', $opt, $this->hostname);
	}

	/**
	 * Method: describe_snapshot_attribute()
	 * 	Returns information about an attribute of a snapshot. Only one attribute can be specified per call.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$snapshot_id - _string_ (Required) The ID of the EBS snapshot whose attribute is being described.
	 *	$attribute - _string_ (Required) The name of the EBS attribute to describe. Available attribute names: createVolumePermission
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_snapshot_attribute($snapshot_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['SnapshotId'] = $snapshot_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('DescribeSnapshotAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: describe_addresses()
	 * 	The DescribeAddresses operation lists elastic IP addresses assigned to your account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	PublicIp - _string_|_array_ (Optional) The optional list of Elastic IP addresses to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Addresses. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_addresses($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['PublicIp']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'PublicIp' => (is_array($opt['PublicIp']) ? $opt['PublicIp'] : array($opt['PublicIp']))
			)));
			unset($opt['PublicIp']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeAddresses', $opt, $this->hostname);
	}

	/**
	 * Method: describe_key_pairs()
	 * 	The DescribeKeyPairs operation returns information about key pairs available to you. If you specify
	 * 	key pairs, information about those key pairs is returned. Otherwise, information for all registered
	 * 	key pairs is returned.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	KeyName - _string_|_array_ (Optional) The optional list of key pair names to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified KeyPairs. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_key_pairs($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['KeyName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'KeyName' => (is_array($opt['KeyName']) ? $opt['KeyName'] : array($opt['KeyName']))
			)));
			unset($opt['KeyName']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeKeyPairs', $opt, $this->hostname);
	}

	/**
	 * Method: describe_image_attribute()
	 * 	The DescribeImageAttribute operation returns information about an attribute of an AMI. Only one
	 * 	attribute can be specified per call.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_id - _string_ (Required) The ID of the AMI whose attribute is to be described.
	 *	$attribute - _string_ (Required) The name of the attribute to describe. Available attribute names: productCodes, kernel, ramdisk, launchPermisson, blockDeviceMapping
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_image_attribute($image_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageId'] = $image_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('DescribeImageAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: confirm_product_instance()
	 * 	The ConfirmProductInstance operation returns true if the specified product code is attached to the
	 * 	specified instance. The operation returns false if the product code is not attached to the instance.
	 *
	 * 	The ConfirmProductInstance operation can only be executed by the owner of the AMI. This feature is
	 * 	useful when an AMI owner is providing support and wants to verify whether a user's instance is
	 * 	eligible.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$product_code - _string_ (Required) The product code to confirm.
	 *	$instance_id - _string_ (Required) The ID of the instance to confirm.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function confirm_product_instance($product_code, $instance_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ProductCode'] = $product_code;
		$opt['InstanceId'] = $instance_id;

		return $this->authenticate('ConfirmProductInstance', $opt, $this->hostname);
	}

	/**
	 * Method: create_volume()
	 * 	Initializes an empty volume of a given size.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$availability_zone - _string_ (Required) The Availability Zone in which to create the new volume.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Size - _integer_ (Optional) The size of the volume, in gigabytes. Required if you are not creating a volume from a snapshot.
	 *	SnapshotId - _string_ (Optional) The ID of the snapshot from which to create the new volume.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_volume($availability_zone, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['AvailabilityZone'] = $availability_zone;

		return $this->authenticate('CreateVolume', $opt, $this->hostname);
	}

	/**
	 * Method: describe_reserved_instances_offerings()
	 * 	The DescribeReservedInstancesOfferings operation describes Reserved Instance offerings that are
	 * 	available for purchase. With Amazon EC2 Reserved Instances, you purchase the right to launch Amazon
	 * 	EC2 instances for a period of time (without getting insufficient capacity errors) and pay a lower
	 * 	usage rate for the actual time used.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	ReservedInstancesOfferingId - _string_|_array_ (Optional) An optional list of the unique IDs of the Reserved Instance offerings to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	InstanceType - _string_ (Optional) The instance type on which the Reserved Instance can be used. [Allowed values: `t1.micro`, `m1.small`, `m1.large`, `m1.xlarge`, `m2.xlarge`, `m2.2xlarge`, `m2.4xlarge`, `c1.medium`, `c1.xlarge`, `cc1.4xlarge`]
	 *	AvailabilityZone - _string_ (Optional) The Availability Zone in which the Reserved Instance can be used.
	 *	ProductDescription - _string_ (Optional) The Reserved Instance product description.
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified ReservedInstanceesOfferings. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_reserved_instances_offerings($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['ReservedInstancesOfferingId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ReservedInstancesOfferingId' => (is_array($opt['ReservedInstancesOfferingId']) ? $opt['ReservedInstancesOfferingId'] : array($opt['ReservedInstancesOfferingId']))
			)));
			unset($opt['ReservedInstancesOfferingId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeReservedInstancesOfferings', $opt, $this->hostname);
	}

	/**
	 * Method: describe_volumes()
	 * 	Describes the status of the indicated or, in lieu of any specified, all volumes belonging to the
	 * 	caller. Volumes that have been deleted are not described.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	VolumeId - _string_|_array_ (Optional) The optional list of EBS volumes to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Volumes. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_volumes($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['VolumeId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'VolumeId' => (is_array($opt['VolumeId']) ? $opt['VolumeId'] : array($opt['VolumeId']))
			)));
			unset($opt['VolumeId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeVolumes', $opt, $this->hostname);
	}

	/**
	 * Method: delete_snapshot()
	 * 	Deletes the snapshot identified by snapshotId.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$snapshot_id - _string_ (Required) The ID of the snapshot to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_snapshot($snapshot_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['SnapshotId'] = $snapshot_id;

		return $this->authenticate('DeleteSnapshot', $opt, $this->hostname);
	}

	/**
	 * Method: monitor_instances()
	 * 	Enables monitoring for a running instance.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_|_array_ (Required) The list of Amazon EC2 instances on which to enable monitoring. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function monitor_instances($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'InstanceId' => (is_array($instance_id) ? $instance_id : array($instance_id))
		)));

		return $this->authenticate('MonitorInstances', $opt, $this->hostname);
	}

	/**
	 * Method: disassociate_address()
	 * 	The DisassociateAddress operation disassociates the specified elastic IP address from the instance
	 * 	to which it is assigned. This is an idempotent operation. If you enter it more than once, Amazon EC2
	 * 	does not return an error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$public_ip - _string_ (Required) The elastic IP address that you are disassociating from the instance.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function disassociate_address($public_ip, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['PublicIp'] = $public_ip;

		return $this->authenticate('DisassociateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: create_placement_group()
	 * 	Creates a PlacementGroup into which multiple Amazon EC2 instances can be launched. Users must give
	 * 	the group a name unique within the scope of the user account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) The name of the `PlacementGroup`.
	 *	$strategy - _string_ (Required) The `PlacementGroup` strategy. [Allowed values: `cluster`]
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_placement_group($group_name, $strategy, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;
		$opt['Strategy'] = $strategy;

		return $this->authenticate('CreatePlacementGroup', $opt, $this->hostname);
	}

	/**
	 * Method: describe_bundle_tasks()
	 * 	The DescribeBundleTasks operation describes in-progress and recent bundle tasks. Complete and failed
	 * 	tasks are removed from the list a short time after completion. If no bundle ids are given, all
	 * 	bundle tasks are returned.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	BundleId - _string_|_array_ (Optional) The list of bundle task IDs to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified BundleTasks. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_bundle_tasks($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['BundleId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'BundleId' => (is_array($opt['BundleId']) ? $opt['BundleId'] : array($opt['BundleId']))
			)));
			unset($opt['BundleId']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeBundleTasks', $opt, $this->hostname);
	}

	/**
	 * Method: bundle_instance()
	 * 	The BundleInstance operation request that an instance is bundled the next time it boots. The
	 * 	bundling process creates a new image from a running instance and stores the AMI data in S3. Once
	 * 	bundled, the image must be registered in the normal way using the RegisterImage API.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	image_id - _string_ (Required) ID of the AMI to launch instances based on.
	 * 	min_count - _integer_ (Required) Minimum number of instances to launch.
	 * 	max_count - _integer_ (Required) Maximum number of instances to launch.
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	BlockDeviceMapping.n.DeviceName - _string_ (Optional; Required if BlockDeviceMapping.n.VirtualName is used) Specifies the device to which you are mapping a virtual name. For example: sdb.
	 * 	BlockDeviceMapping.n.VirtualName - _string_ (Optional; Required if BlockDeviceMapping.n.DeviceName is used) 	Specifies the virtual name to map to the corresponding device name. For example: instancestore0.
	 * 	InstanceType - _string_ (Optional) Specifies the instance type. Options include 'm1.small', 'm1.large', 'm1.xlarge', 'c1.medium', and 'c1.xlarge'. Defaults to 'm1.small'.
	 * 	KernelId - _string_ (Optional) 	The ID of the kernel with which to launch the instance. For information on finding available kernel IDs, see ec2-describe-images.
	 * 	KeyName - _string_ (Optional) Name of the keypair to launch instances with.
	 * 	Placement.AvailabilityZone - _string_ (Optional) Specifies the availability zone in which to launch the instance(s). To display a list of availability zones in which you can launch the instances, use the <describe_availability_zones()> operation. Default is determined by Amazon EC2.
	 * 	RamdiskId - _string_ (Optional) The ID of the RAM disk with which to launch the instance. Some kernels require additional drivers at launch. Check the kernel requirements for information on whether you need to specify a RAM disk. To find kernel requirements, go to the Resource Center and search for the kernel ID.
	 * 	SecurityGroup.n - _string_ (Optional) Names of the security groups to associate the instances with.
	 * 	UserData - _string_ (Optional) The user data available to the launched instances. This should be base64-encoded. See the UserDataType data type for encoding details.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-RunInstances.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <confirm_product_instance()>, <describe_instances()>, <terminate_instances()>
	 */
	public function run_instances($image_id, $min_count, $max_count, $opt = null)
	{
		if (!$opt) $opt = array();

		$opt['ImageId'] = $image_id;
		$opt['MinCount'] = $min_count;
		$opt['MaxCount'] = $max_count;

		return $this->authenticate('RunInstances', $opt, $this->hostname);
	}

	/**
	 * Method: terminate_instances()
	 * 	Shuts down one or more instances. This operation is idempotent and terminating an instance that is in the process of shutting down (or already terminated) will succeed.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	InstanceId.1 - _string_ (Required) One instance ID returned from previous calls to <run_instances()>.
	 * 	InstanceId.n - _string_ (Optional) More than one instance IDs returned from previous calls to <run_instances()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-TerminateInstances.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/elastic_ip.phps
	 * 	Related - <confirm_product_instance()>, <describe_instances()>, <run_instances()>
	 */
	public function terminate_instances($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('TerminateInstances', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// KEYPAIRS

	/**
	 * Method: create_key_pair()
	 * 	Creates a new 2048 bit RSA key pair and returns a unique ID that can be used to reference this key pair when launching new instances. For more information, see <run_instances()>.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	key_name - _string_ (Required) A unique name for the key pair.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-CreateKeyPair.html
	 * 	Related - <delete_key_pair()>, <describe_key_pairs()>
	 */
	public function create_key_pair($key_name, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['KeyName'] = $key_name;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('CreateKeyPair', $opt, $this->hostname);
	}

	/**
	 * Method: delete_key_pair()
	 * 	Deletes a keypair.
=======
	 * 	$instance_id - _string_ (Required) The ID of the instance to bundle.
	 * 	$policy - _ComplexType_ (Required) The details of S3 storage for bundling a Windows instance. A **required** ComplexType must be set by passing a nested associative array with the following entries as keys.
	 * 	$opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $policy parameter:
	 * 	Bucket - _string_ (Optional) The bucket in which to store the AMI. You can specify a bucket that you already own or a new bucket that Amazon EC2 creates on your behalf. If you specify a bucket that belongs to someone else, Amazon EC2 returns an error.
	 * 	Prefix - _string_ (Optional) The prefix to use when storing the AMI in S3.
	 * 	AWSAccessKeyId - _string_ (Optional) The Access Key ID of the owner of the Amazon S3 bucket. Use the <CFPolicy::get_key()> method of a <CFPolicy> instance.
	 * 	UploadPolicy - _string_ (Optional) A Base64-encoded Amazon S3 upload policy that gives Amazon EC2 permission to upload items into Amazon S3 on the user's behalf. Use the <CFPolicy::get_policy()> method of a <CFPolicy> instance.
	 * 	UploadPolicySignature - _string_ (Optional) The signature of the Base64 encoded JSON document. Use the <CFPolicy::get_policy_signature()> method of a <CFPolicy> instance.
	 *
	 * Keys for the $opt parameter:
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This is useful for manually-managed batch requests.
	 *
	 * Returns:
	 * 	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function bundle_instance($instance_id, $policy, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;

		$opt = array_merge($opt, CFComplexType::map(array(
			'Storage.S3' => $policy
		)));

		return $this->authenticate('BundleInstance', $opt, $this->hostname);
	}

	/**
	 * Method: delete_placement_group()
	 * 	Deletes a PlacementGroup from a user's account. Terminate all Amazon EC2 instances in the placement
	 * 	group before deletion.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) The name of the `PlacementGroup` to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_placement_group($group_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;

		return $this->authenticate('DeletePlacementGroup', $opt, $this->hostname);
	}

	/**
	 * Method: revoke_security_group_ingress()
	 * 	The RevokeSecurityGroupIngress operation revokes permissions from a security group. The permissions
	 * 	used to revoke must be specified using the same values used to grant the permissions.
	 *
	 * 	Permissions are specified by IP protocol (TCP, UDP, or ICMP), the source of the request (by IP
	 * 	range or an Amazon EC2 user-group pair), the source and destination port ranges (for TCP and UDP),
	 * 	and the ICMP codes and types (for ICMP).
	 *
	 * 	Permission changes are quickly propagated to instances within the security group. However,
	 * 	depending on the number of instances in the group, a small delay might occur.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$group_name - _string_ (Required) The name of the security group from which to remove permissions.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	SourceSecurityGroupName - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. Name of the source security group. Cannot be used when specifying a CIDR IP address.
	 *	SourceSecurityGroupOwnerId - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. AWS user ID of an account. Cannot be used when specifying a CIDR IP address.
	 *	IpProtocol - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. IP protocol. Valid values: tcp, udp, icmp
	 *	FromPort - _integer_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. Start of port range for the TCP and UDP protocols, or an ICMP type number. An ICMP type number of -1 indicates a wildcard (i.e., any ICMP type number).
	 *	ToPort - _integer_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. End of port range for the TCP and UDP protocols, or an ICMP code. An ICMP code of -1 indicates a wildcard (i.e., any ICMP code).
	 *	CidrIp - _string_ (Optional) Deprecated - use the list of IP permissions to specify this information instead. CIDR range.
	 *	IpPermissions - _ComplexList_ (Optional) List of IP permissions to revoke on the specified security group. For an IP permission to be removed, it must exactly match one of the IP permissions you specify in this list. Specifying permissions through IP permissions is the preferred way of revoking permissions since it offers more flexibility and control. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `IpPermissions` subtype (documented next), or by passing a nested associative array with the following `IpPermissions`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	IpPermissions.x.IpProtocol - _string_ (Optional) The IP protocol of this permission. Valid protocol values: tpc, upd, icmp
	 *	IpPermissions.x.FromPort - _integer_ (Optional) Start of port range for the TCP and UDP protocols, or an ICMP type number. An ICMP type number of -1 indicates a wildcard (i.e., any ICMP type number).
	 *	IpPermissions.x.ToPort - _integer_ (Optional) End of port range for the TCP and UDP protocols, or an ICMP code. An ICMP code of -1 indicates a wildcard (i.e., any ICMP code).
	 *	IpPermissions.x.Groups.y.UserId - _string_ (Optional) The AWS user ID of an account.
	 *	IpPermissions.x.Groups.y.GroupName - _string_ (Optional) The name of the security group in the specified user's account.
	 *	IpPermissions.x.IpRanges.y - _string_ (Optional) The list of CIDR IP ranges included in this permission.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function revoke_security_group_ingress($group_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['GroupName'] = $group_name;

		// Optional parameter
		if (isset($opt['IpPermissions']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('IpPermissions' => $opt['IpPermissions'])));
			unset($opt['IpPermissions']);
		}

		return $this->authenticate('RevokeSecurityGroupIngress', $opt, $this->hostname);
	}

	/**
	 * Method: get_console_output()
	 * 	The GetConsoleOutput operation retrieves console output for the specified instance.
	 *
	 * 	Instance console output is buffered and posted shortly after instance boot, reboot, and
	 * 	termination. Amazon EC2 preserves the most recent 64 KB output which will be available for at least
	 * 	one hour after the most recent post.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	key_name - _string_ (Required) Unique name for this key.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DeleteKeyPair.html
	 * 	Related - <create_key_pair()>, <describe_key_pairs()>
	 */
	public function delete_key_pair($key_name, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['KeyName'] = $key_name;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DeleteKeyPair', $opt, $this->hostname);
	}

	/**
	 * Method: describe_key_pairs()
	 * 	Returns information about key pairs available to you. If you specify key pairs, information about those key pairs is returned. Otherwise, information for all registered key pairs is returned.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	KeyName.n - _string_ (Optional) One or more keypair IDs to describe.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeKeyPairs.html
	 * 	Related - <create_key_pair()>, <delete_key_pair()>
	 */
	public function describe_key_pairs($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeKeyPairs', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// SECURITY GROUPS

	/**
	 * Method: authorize_security_group_ingress()
	 * 	Adds permissions to a security group.
	 *
	 * 	Permissions are specified in terms of the IP protocol (TCP, UDP or ICMP), the source of the request (by IP range or an Amazon EC2 user-group pair), source and destination port ranges (for TCP and UDP), and ICMP codes and types (for ICMP). When authorizing ICMP, -1 may be used as a wildcard in the type and code fields.
	 *
	 * 	Permission changes are propagated to instances within the security group being modified as quickly as possible. However, a small delay is likely, depending on the number of instances that are members of the indicated group.
	 *
	 * 	When authorizing a user/group pair permission, group_name, SourceSecurityGroupName and SourceSecurityGroupOwnerId must be specified. When authorizing a CIDR IP permission, GroupName, IpProtocol, FromPort, ToPort and CidrIp must be specified. Mixing these two types of parameters is not allowed.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	group_name - _string_ (Required) Name of the security group to modify.
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	CidrIp - _string_ (Required when authorizing CIDR IP permission) CIDR IP range to authorize access to when operating on a CIDR IP.
	 * 	FromPort - _integer_ (Required when authorizing CIDR IP permission) Bottom of port range to authorize access to when operating on a CIDR IP. This contains the ICMP type if ICMP is being authorized.
	 * 	ToPort - _integer_ (Required when authorizing CIDR IP permission) Top of port range to authorize access to when operating on a CIDR IP. This contains the ICMP code if ICMP is being authorized.
	 * 	IpProtocol - _string_ (Required when authorizing CIDR IP permission) IP protocol to authorize access to when operating on a CIDR IP. Valid values are 'tcp', 'udp' and 'icmp'.
	 * 	SourceSecurityGroupName - _string_ (Required when authorizing user/group pair permission) Name of security group to authorize access to when operating on a user/group pair.
	 * 	SourceSecurityGroupOwnerId - _string_ (Required when authorizing user/group pair permission) Owner of security group to authorize access to when operating on a user/group pair.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-AuthorizeSecurityGroupIngress.html
	 * 	Related - <revoke_security_group_ingress()>, <create_security_group()>, <delete_security_group()>, <describe_security_groups()>
	 */
	public function authorize_security_group_ingress($group_name, $opt = null)
	{
		if (!$opt) $opt = array();

		$opt['GroupName'] = $group_name;

		return $this->authenticate('AuthorizeSecurityGroupIngress', $opt, $this->hostname);
	}

	/**
	 * Method: create_security_group()
	 * 	Every instance is launched in a security group. If none is specified as part of the launch request then instances are launched in the default security group. Instances within the same security group have unrestricted network access to one another. Instances will reject network access attempts from other instances in a different security group. As the owner of instances you may grant or revoke specific permissions using the <authorize_security_group_ingress()> and <revoke_security_group_ingress()> operations.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	group_name - _string_ (Required) Name for the new security group.
	 * 	group_description - _string_ (Required) Description of the new security group.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-CreateSecurityGroup.html
	 * 	Related - <authorize_security_group_ingress()>, <revoke_security_group_ingress()>, <delete_security_group()>, <describe_security_groups()>
	 */
	public function create_security_group($group_name, $group_description, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['GroupName'] = $group_name;
		$opt['GroupDescription'] = $group_description;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('CreateSecurityGroup', $opt, $this->hostname);
	}

	/**
	 * Method: delete_security_group()
	 * 	Deletes a security group.
	 *
	 * 	If you attempt to delete a security group that contains instances, a fault is returned. If you attempt to delete a security group that is referenced by another security group, a fault is returned. For example, if security group B has a rule that allows access from security group A, security group A cannot be deleted until the allow rule is removed.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	group_name - _string_ (Required) Name for the security group.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DeleteSecurityGroup.html
	 * 	Related - <authorize_security_group_ingress()>, <revoke_security_group_ingress()>, <create_security_group()>, <describe_security_groups()>
	 */
	public function delete_security_group($group_name, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['GroupName'] = $group_name;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('DeleteSecurityGroup', $opt, $this->hostname);
	}

	/**
	 * Method: describe_security_groups()
	 * 	Returns information about security groups owned by the user making the request. An optional list of security group names may be provided to request information for those security groups only. If no security group names are provided, information of all security groups will be returned. If a group is specified that does not exist a fault is returned.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	GroupName.n - _string_ (Optional) List of security groups to describe.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeSecurityGroups.html
	 * 	Related - <authorize_security_group_ingress()>, <revoke_security_group_ingress()>, <create_security_group()>, <delete_security_group()>
	 */
	public function describe_security_groups($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeSecurityGroups', $opt, $this->hostname);
	}

	/**
	 * Method: revoke_security_group_ingress()
	 * 	Revokes existing permissions that were previously granted to a security group. The permissions to revoke must be specified using the same values originally used to grant the permission.
	 *
	 * 	Permissions are specified in terms of the IP protocol (TCP, UDP or ICMP), the source of the request (by IP range or an Amazon EC2 user-group pair), source and destination port ranges (for TCP and UDP), and ICMP codes and types (for ICMP). When authorizing ICMP, -1 may be used as a wildcard in the type and code fields.
	 *
	 * 	Permission changes are propagated to instances within the security group being modified as quickly as possible. However, a small delay is likely, depending on the number of instances that are members of the indicated group.
	 *
	 * 	When revoking a user/group pair permission, group_name, SourceSecurityGroupName and SourceSecurityGroupOwnerId must be specified. When authorizing a CIDR IP permission, GroupName, IpProtocol, FromPort, ToPort and CidrIp must be specified. Mixing these two types of parameters is not allowed.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	group_name - _string_ (Required) Name of the security group to modify.
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	CidrIp - _string_ (Required when revoking CIDR IP permission) CIDR IP range to authorize access to when operating on a CIDR IP.
	 * 	FromPort - _integer_ (Required when revoking CIDR IP permission) Bottom of port range to authorize access to when operating on a CIDR IP. This contains the ICMP type if ICMP is being authorized.
	 * 	ToPort - _integer_ (Required when revoking CIDR IP permission) Top of port range to authorize access to when operating on a CIDR IP. This contains the ICMP code if ICMP is being authorized.
	 * 	IpProtocol - _string_ (Required when revoking CIDR IP permission) IP protocol to authorize access to when operating on a CIDR IP. Valid values are 'tcp', 'udp' and 'icmp'.
	 * 	SourceSecurityGroupName - _string_ (Required when revoking user/group pair permission) Name of security group to authorize access to when operating on a user/group pair.
	 * 	SourceSecurityGroupOwnerId - _string_ (Required when revoking user/group pair permission) Owner of security group to authorize access to when operating on a user/group pair.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-RevokeSecurityGroupIngress.html
	 * 	Related - <authorize_security_group_ingress()>, <create_security_group()>, <delete_security_group()>, <describe_security_groups()>
	 */
	public function revoke_security_group_ingress($group_name, $opt = null)
	{
		if (!$opt) $opt = array();

		$opt['GroupName'] = $group_name;

		return $this->authenticate('RevokeSecurityGroupIngress', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// BUNDLE WINDOWS AMIS

	/**
	 * Method: bundle_instance()
	 * 	Bundles an Amazon EC2 instance running Windows. For more information, see Bundling an AMI in Windows. This operation is for Windows instances only.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	instanceId - _string_ (Required) The ID of the instance to bundle.
	 * 	opt - _array_ (Required) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	Bucket - _string_ (Required) The bucket in which to store the AMI.
	 * 	Prefix - _string_ (Required) The prefix to append to the AMI.
	 * 	UploadPolicy - _array_ (Optional) The upload policy gives Amazon EC2 limited permission to upload items into your Amazon S3 bucket. See example for documentation. If an Upload Policy is not provided, this method will generate one from the provided information setting ONLY the required values, and will set an expiration of 12 hours.
	 * 	AWSAccessKeyId - _string_ (Optional) The Access Key ID of the owner of the Amazon S3 bucket. Defaults to the AWS Key used to authenticate the request.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-BundleInstance.html
	 * 	Upload Policy - http://docs.amazonwebservices.com/AmazonS3/latest/HTTPPOSTExamples.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/bundle_windows.phps
	 * 	Related - <bundle_instance()>, <cancel_bundle_task()>, <describe_bundle_tasks()>
	 */
	public function bundle_instance($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();

		// Instance ID
		$opt['instanceId'] = $instance_id;

		// Storage.S3.Bucket
		if (isset($opt['Bucket']))
		{
			$opt['Storage.S3.Bucket'] = $opt['Bucket'];
			unset($opt['Bucket']);
		}

		// Storage.S3.Prefix
		if (isset($opt['Prefix']))
		{
			$opt['Storage.S3.Prefix'] = $opt['Prefix'];
			unset($opt['Prefix']);
		}

		// Storage.S3.AWSAccessKeyId
		if (isset($opt['AWSAccessKeyId']))
		{
			$opt['Storage.S3.AWSAccessKeyId'] = $opt['AWSAccessKeyId'];
			unset($opt['AWSAccessKeyId']);
		}
		else
		{
			$opt['Storage.S3.AWSAccessKeyId'] = $this->key;
		}

		// Storage.S3.UploadPolicy
		if (isset($opt['UploadPolicy']))
		{
			$opt['Storage.S3.UploadPolicy'] = base64_encode($this->util->json_encode($opt['UploadPolicy']));
			unset($opt['UploadPolicy']);
		}
		else
		{
			$opt['Storage.S3.UploadPolicy'] = base64_encode($this->util->json_encode(array(
				'expiration' => gmdate(DATE_FORMAT_ISO8601, strtotime('+12 hours')),
				'conditions' => array(
					array('bucket' => $opt['Storage.S3.Bucket']),
					array('acl' => 'ec2-bundle-read')
				)
			)));
		}

		// Storage.S3.UploadPolicySignature
		$opt['Storage.S3.UploadPolicySignature'] = $this->util->hex_to_base64(hash_hmac('sha1', base64_encode($opt['Storage.S3.UploadPolicy']), $this->secret_key));

		return $this->authenticate('BundleInstance', $opt, $this->hostname);
	}

	/**
	 * Method: cancel_bundle_task()
	 * 	Cancels an Amazon EC2 bundling operation. For more information on bundling instances, see Bundling an AMI in Windows. This operation is for Windows instances only.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	bundle_id - _string_ (Required) The ID of the bundle task to cancel.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-CancelBundleTask.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/bundle_windows.phps
	 * 	Related - <bundle_instance()>, <cancel_bundle_task()>, <describe_bundle_tasks()>
	 */
	public function cancel_bundle_task($bundle_id, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['bundleId'] = $bundle_id;
		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('CancelBundleTask', $opt, $this->hostname);
	}

	/**
	 * Method: describe_bundle_tasks()
	 * 	Describes current bundling tasks. For more information on bundling instances, see Bundling an AMI in Windows. This operation is for Windows instances only.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	bundleId - _string_ (Optional) The ID of the bundle task to describe. If no ID is specified, all bundle tasks are described.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSEC2/latest/DeveloperGuide/ApiReference-Query-DescribeBundleTasks.html
	 * 	Example Usage - http://getcloudfusion.com/docs/examples/ec2/bundle_windows.phps
	 * 	Related - <bundle_instance()>, <cancel_bundle_task()>, <describe_bundle_tasks()>
	 */
	public function describe_bundle_tasks($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DescribeBundleTasks', $opt, $this->hostname);
	}
}
=======
	 * 	$instance_id - _string_ (Required) The ID of the instance for which you want console output.
	 * 	$opt - _array_ (Optional) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This is useful for manually-managed batch requests.
	 *
	 * Returns:
	 * 	_CFResponse_ A <CFResponse> object containing a parsed HTTP response. The value of `output` is automatically Base64-decoded.
	 */
	public function get_console_output($instance_id, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;

		$response = $this->authenticate('GetConsoleOutput', $opt, $this->hostname);

		// Automatically Base64-decode the <output> value.
		if ($this->util->is_base64((string) $response->body->output))
		{
			$response->body->output = base64_decode($response->body->output);
		}

		return $response;
	}

	/**
	 * Method: allocate_address()
	 * 	The AllocateAddress operation acquires an elastic IP address for use with your account.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function allocate_address($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('AllocateAddress', $opt, $this->hostname);
	}

	/**
	 * Method: modify_image_attribute()
	 * 	The ModifyImageAttribute operation modifies an attribute of an AMI.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_id - _string_ (Required) The ID of the AMI whose attribute you want to modify.
	 *	$attribute - _string_ (Required) The name of the AMI attribute you want to modify. Available attributes: launchPermission, productCodes
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	OperationType - _string_ (Optional) The type of operation being requested. Available operation types: add, remove
	 *	UserId - _string_|_array_ (Optional) The AWS user ID being added to or removed from the list of users with launch permissions for this AMI. Only valid when the launchPermission attribute is being modified. Pass a string for a single value, or an indexed array for multiple values..
	 *	UserGroup - _string_|_array_ (Optional) The user group being added to or removed from the list of user groups with launch permissions for this AMI. Only valid when the launchPermission attribute is being modified. Available user groups: all Pass a string for a single value, or an indexed array for multiple values..
	 *	ProductCode - _string_|_array_ (Optional) The list of product codes being added to or removed from the specified AMI. Only valid when the productCodes attribute is being modified. Pass a string for a single value, or an indexed array for multiple values..
	 *	Value - _string_ (Optional) The value of the attribute being modified. Only valid when the description attribute is being modified.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function modify_image_attribute($image_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageId'] = $image_id;
		$opt['Attribute'] = $attribute;

		// Optional parameter
		if (isset($opt['UserId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'UserId' => (is_array($opt['UserId']) ? $opt['UserId'] : array($opt['UserId']))
			)));
			unset($opt['UserId']);
		}

		// Optional parameter
		if (isset($opt['UserGroup']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'UserGroup' => (is_array($opt['UserGroup']) ? $opt['UserGroup'] : array($opt['UserGroup']))
			)));
			unset($opt['UserGroup']);
		}

		// Optional parameter
		if (isset($opt['ProductCode']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'ProductCode' => (is_array($opt['ProductCode']) ? $opt['ProductCode'] : array($opt['ProductCode']))
			)));
			unset($opt['ProductCode']);
		}

		return $this->authenticate('ModifyImageAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: release_address()
	 * 	The ReleaseAddress operation releases an elastic IP address associated with your account.
	 *
	 * 	Releasing an IP address automatically disassociates it from any instance with which it is
	 * 	associated. For more information, see DisassociateAddress.
	 *
	 * 	After releasing an elastic IP address, it is released to the IP address pool and might no longer be
	 * 	available to your account. Make sure to update your DNS records and any servers or devices that
	 * 	communicate with the address.
	 *
	 * 	If you run this operation on an elastic IP address that is already released, the address might be
	 * 	assigned to another account which will cause Amazon EC2 to return an error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$public_ip - _string_ (Required) The elastic IP address that you are releasing from your account.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function release_address($public_ip, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['PublicIp'] = $public_ip;

		return $this->authenticate('ReleaseAddress', $opt, $this->hostname);
	}

	/**
	 * Method: reset_instance_attribute()
	 * 	Resets an attribute of an instance to its default value.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The ID of the Amazon EC2 instance whose attribute is being reset.
	 *	$attribute - _string_ (Required) The name of the attribute being reset. Available attribute names: kernel, ramdisk
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function reset_instance_attribute($instance_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('ResetInstanceAttribute', $opt, $this->hostname);
	}

	/**
	 * Method: create_spot_datafeed_subscription()
	 * 	Creates the data feed for Spot Instances, enabling you to view Spot Instance usage logs. You can
	 * 	create one data feed per account.
	 *
	 * 	For conceptual information about Spot Instances, refer to the Amazon Elastic Compute Cloud
	 * 	Developer Guide or Amazon Elastic Compute Cloud User Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$bucket - _string_ (Required) The Amazon S3 bucket in which to store the Spot Instance datafeed.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Prefix - _string_ (Optional) The prefix that is prepended to datafeed files.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_spot_datafeed_subscription($bucket, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['Bucket'] = $bucket;

		return $this->authenticate('CreateSpotDatafeedSubscription', $opt, $this->hostname);
	}

	/**
	 * Method: create_key_pair()
	 * 	The CreateKeyPair operation creates a new 2048 bit RSA key pair and returns a unique ID that can be
	 * 	used to reference this key pair when launching new instances. For more information, see
	 * 	RunInstances.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$key_name - _string_ (Required) The unique name for the new key pair.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_key_pair($key_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['KeyName'] = $key_name;

		return $this->authenticate('CreateKeyPair', $opt, $this->hostname);
	}

	/**
	 * Method: describe_snapshots()
	 * 	Returns information about the Amazon EBS snapshots available to you. Snapshots available to you
	 * 	include public snapshots available for any AWS account to launch, private snapshots you own, and
	 * 	private snapshots owned by another AWS account but for which you've been given explicit create
	 * 	volume permissions.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	SnapshotId - _string_|_array_ (Optional) The optional list of EBS snapshot IDs to describe. Pass a string for a single value, or an indexed array for multiple values..
	 *	Owner - _string_|_array_ (Optional) The optional list of EBS snapshot owners. Pass a string for a single value, or an indexed array for multiple values..
	 *	RestorableBy - _string_|_array_ (Optional) The optional list of users who have permission to create volumes from the described EBS snapshots. Pass a string for a single value, or an indexed array for multiple values..
	 *	Filter - _ComplexList_ (Optional) A list of filters used to match tags associated with the specified Snapshots. For a complete reference to the available filter keys for this operation, see the Amazon EC2 API reference. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `Filter` subtype (documented next), or by passing a nested associative array with the following `Filter`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	Filter.x.Name - _string_ (Optional) Specifies the name of the filter.
	 *	Filter.x.Value.y - _string_ (Optional) Contains one or more values for the filter.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_snapshots($opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['SnapshotId']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'SnapshotId' => (is_array($opt['SnapshotId']) ? $opt['SnapshotId'] : array($opt['SnapshotId']))
			)));
			unset($opt['SnapshotId']);
		}

		// Optional parameter
		if (isset($opt['Owner']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'Owner' => (is_array($opt['Owner']) ? $opt['Owner'] : array($opt['Owner']))
			)));
			unset($opt['Owner']);
		}

		// Optional parameter
		if (isset($opt['RestorableBy']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'RestorableBy' => (is_array($opt['RestorableBy']) ? $opt['RestorableBy'] : array($opt['RestorableBy']))
			)));
			unset($opt['RestorableBy']);
		}

		// Optional parameter
		if (isset($opt['Filter']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('Filter' => $opt['Filter'])));
			unset($opt['Filter']);
		}

		return $this->authenticate('DescribeSnapshots', $opt, $this->hostname);
	}

	/**
	 * Method: register_image()
	 * 	The RegisterImage operation registers an AMI with Amazon EC2. Images must be registered before they
	 * 	can be launched. For more information, see RunInstances.
	 *
	 * 	Each AMI is associated with an unique ID which is provided by the Amazon EC2 service through the
	 * 	RegisterImage operation. During registration, Amazon EC2 retrieves the specified image manifest from
	 * 	Amazon S3 and verifies that the image is owned by the user registering the image.
	 *
	 * 	The image manifest is retrieved once and stored within the Amazon EC2. Any modifications to an
	 * 	image in Amazon S3 invalidates this registration. If you make changes to an image, deregister the
	 * 	previous image and register the new image. For more information, see DeregisterImage.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$image_location - _string_ (Required) The full path to your AMI manifest in Amazon S3 storage.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	Name - _string_ (Optional) The name to give the new Amazon Machine Image. Constraints: 3-128 alphanumeric characters, parenthesis (()), commas (,), slashes (/), dashes (-), or underscores(_)
	 *	Description - _string_ (Optional) The description describing the new AMI.
	 *	Architecture - _string_ (Optional) The architecture of the image. Valid Values: i386, x86_64
	 *	KernelId - _string_ (Optional) The optional ID of a specific kernel to register with the new AMI.
	 *	RamdiskId - _string_ (Optional) The optional ID of a specific ramdisk to register with the new AMI. Some kernels require additional drivers at launch. Check the kernel requirements for information on whether you need to specify a RAM disk.
	 *	RootDeviceName - _string_ (Optional) The root device name (e.g., /dev/sda1).
	 *	BlockDeviceMapping - _ComplexList_ (Optional) The block device mappings for the new AMI, which specify how different block devices (ex: EBS volumes and ephemeral drives) will be exposed on instances launched from the new image. A ComplexList is an indexed array of ComplexTypes -- each of which can be set two ways: by setting each individual `BlockDeviceMapping` subtype (documented next), or by passing a nested associative array with the following `BlockDeviceMapping`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	BlockDeviceMapping.x.VirtualName - _string_ (Optional) Specifies the virtual device name.
	 *	BlockDeviceMapping.x.DeviceName - _string_ (Optional) Specifies the device name (e.g., /dev/sdh).
	 *	BlockDeviceMapping.x.Ebs.SnapshotId - _string_ (Optional) The ID of the snapshot from which the volume will be created.
	 *	BlockDeviceMapping.x.Ebs.VolumeSize - _integer_ (Optional) The size of the volume, in gigabytes.
	 *	BlockDeviceMapping.x.Ebs.DeleteOnTermination - _boolean_ (Optional) Specifies whether the Amazon EBS volume is deleted on instance termination.
	 *	BlockDeviceMapping.x.NoDevice - _string_ (Optional) Specifies the device name to suppress during instance launch.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function register_image($image_location, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ImageLocation'] = $image_location;

		// Optional parameter
		if (isset($opt['BlockDeviceMapping']))
		{
			$opt = array_merge($opt, CFComplexType::map(array('BlockDeviceMapping' => $opt['BlockDeviceMapping'])));
			unset($opt['BlockDeviceMapping']);
		}

		return $this->authenticate('RegisterImage', $opt, $this->hostname);
	}

	/**
	 * Method: describe_instance_attribute()
	 * 	Returns information about an attribute of an instance. Only one attribute can be specified per call.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$instance_id - _string_ (Required) The ID of the instance whose instance attribute is being described.
	 *	$attribute - _string_ (Required) The name of the attribute to describe. Available attribute names: instanceType, kernel, ramdisk, userData, disableApiTermination, instanceInitiatedShutdownBehavior, rootDeviceName, blockDeviceMapping
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function describe_instance_attribute($instance_id, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['InstanceId'] = $instance_id;
		$opt['Attribute'] = $attribute;

		return $this->authenticate('DescribeInstanceAttribute', $opt, $this->hostname);
	}
}

>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
