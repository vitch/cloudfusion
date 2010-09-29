<?php
<<<<<<< HEAD
/**
 * File: Amazon SQS
 * 	Amazon Simple Queue Service (http://aws.amazon.com/sqs)
 *
 * Version:
* 	2009.08.26
 *
 * Copyright:
 * 	2006-2010 Ryan Parman, Foleeo, Inc., and contributors.
 *
 * License:
 * 	Simplified BSD License - http://opensource.org/licenses/bsd-license.php
 *
 * See Also:
 * 	CloudFusion - http://getcloudfusion.com
 * 	Amazon SQS - http://aws.amazon.com/sqs
 */


/*%******************************************************************************************%*/
// CONSTANTS

/**
 * Constant: SQS_DEFAULT_URL
 * 	Specify the default queue URL.
 */
define('SQS_DEFAULT_URL', 'queue.amazonaws.com');

/**
 * Constant: SQS_LOCATION_US
 * 	Specify the queue URL for the U.S.-specific hostname.
 */
define('SQS_LOCATION_US', '');

/**
 * Constant: SQS_LOCATION_EU
 * 	Specify the queue URL for the E.U.-specific hostname.
 */
define('SQS_LOCATION_EU', 'eu-west-1.');
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
 * File: AmazonSQS
 * 	Amazon Simple Queue Service (Amazon SQS) offers a reliable, highly scalable, hosted queue for
 * 	storing messages as they travel between computers. By using Amazon SQS, developers can simply move
 * 	data between distributed components of their applications that perform different tasks, without
 * 	losing messages or requiring each component to be always available. Amazon SQS makes it easy to
 * 	build an automated workflow, working in close conjunction with the Amazon Elastic Compute Cloud
 * 	(Amazon EC2) and the other AWS infrastructure web services.
 *
 * 	Amazon SQS works by exposing Amazon's web-scale messaging infrastructure as a web service. Any
 * 	computer on the Internet can add or read messages without any installed software or special firewall
 * 	configurations. Components of applications using Amazon SQS can run independently, and do not need
 * 	to be on the same network, developed with the same technologies, or running at the same time.
 *
 * 	Visit [http://aws.amazon.com/sqs/](http://aws.amazon.com/sqs/) for more information.
 *
 * Version:
 * 	Mon Sep 27 19:44:49 PDT 2010
 *
 * License and Copyright:
 * 	See the included NOTICE.md file for complete information.
 *
 * See Also:
 * 	[Amazon Simple Queue Service](http://aws.amazon.com/sqs/)
 * 	[Amazon Simple Queue Service documentation](http://aws.amazon.com/documentation/sqs/)
 */
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb


/*%******************************************************************************************%*/
// EXCEPTIONS

/**
 * Exception: SQS_Exception
 * 	Default SQS Exception.
 */
class SQS_Exception extends Exception {}


/*%******************************************************************************************%*/
// MAIN CLASS

/**
 * Class: AmazonSQS
<<<<<<< HEAD
 * 	Container for all Amazon SQS-related methods. Inherits additional methods from CloudFusion.
 *
 * Extends:
 * 	CloudFusion
 */
class AmazonSQS extends CloudFusion
{
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
	 *
	 * Returns:
	 * 	_boolean_ false if no valid values are set, otherwise true.
	 */
	public function __construct($key = null, $secret_key = null)
	{
		$this->api_version = '2009-02-01';
		$this->hostname = SQS_DEFAULT_URL;

		if (!$key && !defined('AWS_KEY'))
		{
			throw new SQS_Exception('No account key was passed into the constructor, nor was it set in the AWS_KEY constant.');
		}

		if (!$secret_key && !defined('AWS_SECRET_KEY'))
		{
			throw new SQS_Exception('No account secret was passed into the constructor, nor was it set in the AWS_SECRET_KEY constant.');
		}

		return parent::__construct($key, $secret_key);
	}


	/*%******************************************************************************************%*/
	// MISCELLANEOUS

	/**
	 * Method: set_locale()
	 * 	By default SQS will self-select the most appropriate locale. This allows you to explicitly sets the locale for SQS to use.
=======
 * 	Container for all service-related methods.
 */
class AmazonSQS extends CFRuntime
{

	/*%******************************************************************************************%*/
	// CLASS CONSTANTS

	/**
	 * Constant: DEFAULT_URL
	 * 	Specify the default queue URL.
	 */
	const DEFAULT_URL = 'sqs.us-east-1.amazonaws.com';

	/**
	 * Constant: REGION_US_E1
	 * 	Specify the queue URL for the US-East (Northern Virginia) Region.
	 */
	const REGION_US_E1 = self::DEFAULT_URL;

	/**
	 * Constant: REGION_US_W1
	 * 	Specify the queue URL for the US-West (Northern California) Region.
	 */
	const REGION_US_W1 = 'sqs.us-west-1.amazonaws.com';

	/**
	 * Constant: REGION_EU_W1
	 * 	Specify the queue URL for the EU (Ireland) Region.
	 */
	const REGION_EU_W1 = 'sqs.eu-west-1.amazonaws.com';

	/**
	 * Constant: REGION_APAC_SE1
	 * 	Specify the queue URL for the Asia Pacific (Singapore) Region.
	 */
	const REGION_APAC_SE1 = 'sqs.ap-southeast-1.amazonaws.com';


	/*%******************************************************************************************%*/
	// SETTERS

	/**
	 * Method: set_region()
	 * 	This allows you to explicitly sets the region for the service to use.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	locale - _string_ (Required) The locale to explicitly set for SQS. Available options are <SQS_LOCATION_US> and <SQS_LOCATION_EU>.
	 *
	 * Returns:
	 * 	void
 	 *
	 * Examples:
	 * 	example::sqs/1_create_queue3.phpt:
	 * 	example::sqs/5_send_message3.phpt:
 	 * 	example::sqs/z_delete_queue3.phpt:
	 */
	public function set_locale($locale)
	{
		$this->hostname = $locale . SQS_DEFAULT_URL;
=======
	 * 	$region - _string_ (Required) The region to explicitly set. Available options are <REGION_US_E1>, <REGION_US_W1>, <REGION_EU_W1>, or <REGION_APAC_SE1>.
	 *
	 * Returns:
	 * 	`$this`
	 */
	public function set_region($region)
	{
		$this->set_hostname($region);
		return $this;
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	}


	/*%******************************************************************************************%*/
<<<<<<< HEAD
	// QUEUES

	/**
	 * Method: create_queue()
	 * 	Creates a new queue to store messages in. You must provide a queue name that is unique within the scope of the queues you own. The queue is assigned a queue URL; you must use this URL when performing actions on the queue. When you create a queue, if a queue with the same name already exists, <create_queue()> returns the queue URL with an error indicating that the queue already exists.
=======
	// CONVENIENCE METHODS

	/**
	 * Method: get_queue_size()
	 * 	Returns the approximate number of messages in the queue.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	queue_name - _string_ (Required) The name of the queue to use for this action. The queue name must be unique within the scope of all your queues.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/1_create_queue.phpt:
 	 * 	example::sqs/1_create_queue3.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryCreateQueue.html
	 * 	Related - <delete_queue()>, <list_queues()>, <get_queue_attributes()>, <set_queue_attributes()>
	 */
	public function create_queue($queue_name, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['QueueName'] = $queue_name;
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('CreateQueue', $opt, $this->hostname);
	}

	/**
	 * Method: delete_queue()
	 * 	Deletes the queue specified by the queue URL. This will delete the queue even if it's not empty.
=======
	 * 	$queue_url - _string_ (Required) The queue URL to perform the action on. Retrieved when the queue is first created.
	 *
	 * Returns:
	 * 	_mixed_ The Approximate number of messages in the queue as an integer. If the queue doesn't exist, it returns the entire <CFResponse> object.
	 */
	public function get_queue_size($queue_url)
	{
		$response = $this->get_queue_attributes($queue_url, array(
			'AttributeName' => 'ApproximateNumberOfMessages'
		));

		if (!$response->isOK())
		{
			return $response;
		}

		return (integer) $response->body->Value(0);
	}

	/**
	 * Method: get_queue_list()
	 * 	ONLY lists the queue URLs, as an array, on the SQS account.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/z_delete_queue.phpt:
 	 * 	example::sqs/z_delete_queue3.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryDeleteQueue.html
	 * 	Related - <create_queue()>, <list_queues()>, <get_queue_attributes()>, <set_queue_attributes()>
	 */
	public function delete_queue($queue_name, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('DeleteQueue', $opt, $this->hostname . '/' . $queue_name);
	}

	/**
	 * Method: list_queues()
	 * 	Returns a list of your queues. A maximum 1000 queue URLs are returned. If you specify a value for the optional <queue_name_prefix> parameter, only queues with a name beginning with the specified value are returned.
=======
	 * 	$pcre - _string_ (Optional) A Perl-Compatible Regular Expression (PCRE) to filter the names against.
	 *
	 * Returns:
	 * 	_array_ The list of matching queue names. If there are no results, the method will return an empty array.
	 *
	 * See Also:
	 * 	[Perl-Compatible Regular Expression (PCRE) Docs](http://php.net/pcre)
	 */
	public function get_queue_list($pcre = null)
	{
		if ($this->use_batch_flow)
		{
			throw new SQS_Exception(__FUNCTION__ . '() cannot be batch requested');
		}

		// Get a list of queues.
		$list = $this->list_queues();
		if ($list = $list->body->QueueUrl())
		{
			$list = $list->map_string($pcre);
			return $list;
		}

		return array();
	}


	/*%******************************************************************************************%*/
	// CONSTRUCTOR

	/**
	 * Method: __construct()
	 * 	Constructs a new instance of <AmazonSQS>.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
<<<<<<< HEAD
	 * 	queue_name_prefix - _string_ (Optional) String to use for filtering the list results. Only those queues whose name begins with the specified string are returned.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/2_list_queues.phpt:
 	 * 	example::sqs/2_list_queues2.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryListQueues.html
	 * 	Related - <create_queue()>, <delete_queue()>, <get_queue_attributes()>, <set_queue_attributes()>
	 */
	public function list_queues($queue_name_prefix = null, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['returnCurlHandle'] = $returnCurlHandle;
		if ($queue_name_prefix)
		{
			$opt['QueueNamePrefix'] = $queue_name_prefix;
		}
		return $this->authenticate('ListQueues', $opt, $this->hostname);
	}

	/**
	 * Method: get_queue_attributes()
	 * 	Gets one or all attributes of a queue.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	attributes - _string_|_array_ (Optional) The attribute you want to get. Setting this value to 'All' returns all the queue's attributes. Pass a string for a single attribute, or an indexed array for multiple attributes. Possible values are 'All', 'ApproximateNumberOfMessages', 'VisibilityTimeout', 'CreatedTimestamp', 'LastModifiedTimestamp', and 'Policy'. Defaults to 'All'.
 	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/4_get_queue_attributes.phpt:
 	 * 	example::sqs/4_get_queue_attributes4.phpt:
 	 * 	example::sqs/4_get_queue_attributes5.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryGetQueueAttributes.html
	 * 	Related - <create_queue()>, <delete_queue()>, <list_queues()>, <set_queue_attributes()>
	 */
	public function get_queue_attributes($queue_name, $attributes = 'All', $returnCurlHandle = null)
	{
		$opt = array();

		if (is_array($attributes))
		{
			for ($i = 0, $max = count($attributes); $i < $max; $i++)
			{
				$opt['AttributeName.' . ($i + 1)] = $attributes[$i];
			}
		}
		else
		{
			$opt['AttributeName.1'] = $attributes;
		}

		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('GetQueueAttributes', $opt, $this->hostname . '/' . $queue_name);
=======
	 * 	$key - _string_ (Optional) Your Amazon API Key. If blank, it will look for the <AWS_KEY> constant.
	 * 	$secret_key - _string_ (Optional) Your Amazon API Secret Key. If blank, it will look for the <AWS_SECRET_KEY> constant.
	 *
	 * Returns:
	 * 	_boolean_ false if no valid values are set, otherwise true.
	 */
	public function __construct($key = null, $secret_key = null)
	{
		$this->api_version = '2009-02-01';
		$this->hostname = self::DEFAULT_URL;

		if (!$key && !defined('AWS_KEY'))
		{
			throw new SQS_Exception('No account key was passed into the constructor, nor was it set in the AWS_KEY constant.');
		}

		if (!$secret_key && !defined('AWS_SECRET_KEY'))
		{
			throw new SQS_Exception('No account secret was passed into the constructor, nor was it set in the AWS_SECRET_KEY constant.');
		}

		return parent::__construct($key, $secret_key);
	}


	/*%******************************************************************************************%*/
	// SERVICE METHODS

	/**
	 * Method: list_queues()
	 * 	The ListQueues action returns a list of your queues.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	QueueNamePrefix - _string_ (Optional) A string to use for filtering the list results. Only those queues whose name begins with the specified string are returned.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function list_queues($opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('ListQueues', $opt, $this->hostname);
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
	}

	/**
	 * Method: set_queue_attributes()
<<<<<<< HEAD
	 * 	Sets an attribute of a queue. Currently, you can set only the <VisibilityTimeout> attribute for a queue. See Visibility Timeout for more information.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	opt - _array_ (Required) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	VisibilityTimeout - _integer_ (Optional) Must be an integer from 0 to 7200 (2 hours).
	 * 	Policy - _string_ (Optional) A policy generated by <generate_policy()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/3_set_queue_attributes.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryGetQueueAttributes.html
	 * 	Related - <create_queue()>, <delete_queue()>, <list_queues()>, <get_queue_attributes()>
	 */
	public function set_queue_attributes($queue_name, $opt = null)
	{
		if (!$opt) $opt = array();

		$count = 1;

		if (isset($opt['VisibilityTimeout']))
		{
			$opt['Attribute.' . $count . '.Name'] = 'VisibilityTimeout';
			$opt['Attribute.' . $count . '.Value'] = $opt['VisibilityTimeout'];
			unset($opt['VisibilityTimeout']);
			$count++;
		}

		if (isset($opt['Policy']))
		{
			$opt['Attribute.' . $count . '.Name'] = 'Policy';
			$opt['Attribute.' . $count . '.Value'] = $opt['Policy'];
			unset($opt['VisibilityTimeout']);
			$count++;
		}

		return $this->authenticate('SetQueueAttributes', $opt, $this->hostname . '/' . $queue_name);
	}


	/*%******************************************************************************************%*/
	// MESSAGES

	/**
	 * Method: send_message()
	 * 	Delivers a message to the specified queue.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	message - _string_ (Required) Message size cannot exceed 8 KB. Allowed Unicode characters (according to http://www.w3.org/TR/REC-xml/#charsets): #x9 | #xA | #xD | [#x20-#xD7FF] | [#xE000-#xFFFD] | [#x10000-#x10FFFF].
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/5_send_message.phpt:
 	 * 	example::sqs/5_send_message3.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QuerySendMessage.html
	 * 	Related - <send_message()>, <receive_message()>, <delete_message()>, <change_message_visibility()>
	 */
	public function send_message($queue_name, $message, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('SendMessage', $opt, $this->hostname . '/' . $queue_name, $message);
	}

	/**
	 * Method: receive_message()
	 * 	Retrieves one or more messages from the specified queue, including the message body and message ID of each message. Messages returned by this action stay in the queue until you delete them. However, once a message is returned to a <receive_message()> request, it is not returned on subsequent <receive_message()> requests for the duration of the <VisibilityTimeout>. If you do not specify a <VisibilityTimeout> in the request, the overall visibility timeout for the queue is used for the returned messages. A default visibility timeout of 30 seconds is set when you create the queue. You can also set the visibility timeout for the queue by using <set_queue_attributes()>. See Visibility Timeout for more information.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	opt - _array_ (Required) Associative array of parameters which can have the following keys:
	 *
	 * Keys for the $opt parameter:
	 * 	AttributeName - _string_|_array_ (Optional) The attribute you want to get. Pass a string for a single attribute, or an indexed array for multiple attributes. Possible values are 'SenderId' and 'SentTimestamp'.
	 * 	VisibilityTimeout - _integer_ (Optional) Must be an integer from 0 to 7200 (2 hours).
	 * 	MaxNumberOfMessages - _integer_ (Optional) Maximum number of messages to return, from 1 to 10. Not necessarily all the messages in the queue are returned. If there are fewer messages in the queue than <MaxNumberOfMessages>, the maximum number of messages returned is the current number of messages in the queue. Defaults to 1 message.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/7_receive_message.phpt:
 	 * 	example::sqs/7_receive_message3.phpt:
 	 * 	example::sqs/7_receive_message4.phpt:
 	 * 	example::sqs/7_receive_message7.phpt:
 	 * 	example::sqs/7_receive_message8.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryReceiveMessage.html
	 * 	Related - <send_message()>, <receive_message()>, <delete_message()>, <change_message_visibility()>
	 */
	public function receive_message($queue_name, $opt = null)
	{
		if (!$opt) $opt = array();

		if (isset($opt['AttributeName']))
		{
			if (is_array($opt['AttributeName']))
			{
				for ($i = 0, $max = count($opt['AttributeName']); $i < $max; $i++)
				{
					$opt['AttributeName.' . ($i + 1)] = $opt['AttributeName'][$i];
				}
			}
			else
			{
				$opt['AttributeName.1'] = $opt['AttributeName'];
			}

			unset($opt['AttributeName']);
		}

		return $this->authenticate('ReceiveMessage', $opt, $this->hostname . '/' . $queue_name);
	}

	/**
	 * Method: delete_message()
	 * 	Unconditionally removes the specified message from the specified queue. Even if the message is locked by another reader due to the visibility timeout setting, it is still deleted from the queue.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	receipt_handle - _string_ (Required) The receipt handle of the message to delete, returned by <receive_message()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 * 	example::sqs/8_delete_message.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/Query_QueryDeleteMessage.html
	 * 	Related - <send_message()>, <receive_message()>, <delete_message()>, <change_message_visibility()>
	 */
	public function delete_message($queue_name, $receipt_handle, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ReceiptHandle'] = $receipt_handle;
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('DeleteMessage', $opt, $this->hostname . '/' . $queue_name);
	}

	/**
	 * Method: change_message_visibility()
	 * 	Changes the visibility timeout of a specified message in a queue to a new value. The maximum allowed timeout value you can set the value to is 12 hours. This means you can't extend the timeout of a message in an existing queue to more than a total visibility timeout of 12 hours.
	 *
	 * 	For example, let's say you have a message and its default message visibility timeout is 30 minutes. You could call ChangeMessageVisiblity with a value of two hours and the effective timeout would be two hours and 30 minutes. When that time comes near you could again extend the time out by calling ChangeMessageVisiblity, but this time the maximum allowed timeout would be 9 hours and 30 minutes.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	receipt_handle - _string_ (Required) The receipt handle associated with the message whose visibility timeout you want to change. This parameter is returned by <receive_message()>.
	 * 	visibility_timeout - _string_ (Required) The new value for the message's visibility timeout (in seconds). This value is limited to 43200 seconds (12 hours).
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/index.html?Query_QueryChangeMessageVisibility.html
	 * 	Related - <send_message()>, <receive_message()>, <delete_message()>, <change_message_visibility()>
	 */
	public function change_message_visibility($receipt_handle, $visibility_timeout, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['ReceiptHandle'] = $receipt_handle;
		$opt['VisibilityTimeout'] = $visibility_timeout;
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('ChangeMessageVisibility', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// ACCESS CONTROL METHODS

	/**
	 *
	 */
	public function generate_policy()
	{

	}

	/**
	 * Method: add_permission()
	 * 	Adds a permission to a queue for a specific principal. This allows for sharing access to the queue. When you create a queue, you have full control access rights for the queue. Only you (as owner of the queue) can grant or deny permissions to the queue.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
 	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 * 	label - _string_ (Required) The unique identification of the permission you're setting. Maximum 80 characters; alphanumeric characters, hyphens (-), and underscores (_) are allowed.
	 * 	permissions - _array_ (Required) An associative array of AWS account numbers (key) and the actions they're allowed to execute (value). AWS account numbers are for those who will be given permission. Actions can be passed as a string for a single action, or an indexed array for multiple actions. Valid values are '*', 'SendMessage', 'ReceiveMessage', 'DeleteMessage', 'ChangeMessageVisibility', or 'GetQueueAttributes'.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
	 * 	example::sqs/add_permission.phpt:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/index.html?Query_QueryAddPermission.html
	 * 	Related - <add_permission()>, <remove_permission()>, <generate_policy()>
	 */
	public function add_permission($queue_name, $label, $permissions, $returnCurlHandle = null)
	{
		$opt = array();
		$opt['Label'] = $label;

		// Starting point.
		$count = 1;

		// Parse through the array
		if (is_array($permissions))
		{
			foreach ($permissions as $account_id => $actions)
			{
				if (is_array($actions))
				{
					foreach ($actions as $action)
					{
						$opt['AWSAccountId.' . $count] = $account_id;
						$opt['ActionName.' . $count] = $action;

						$count++;
					}
				}
				else
				{
					$opt['AWSAccountId.1'] = $account_id;
					$opt['ActionName.1'] = $actions;
				}

				$count++;
			}
		}
		else
		{
			throw new SQS_Exception('$permissions MUST be an associative array of AWS Account IDs and Actions they\'re allowed to execute.');
		}

		$opt['returnCurlHandle'] = $returnCurlHandle;

		return $this->authenticate('AddPermission', $opt, $this->hostname . '/' . $queue_name);
	}

	/**
	 * Method: remove_permission()
	 * 	Revokes any permissions in the queue policy that matches the Label parameter. Only the owner of the queue can remove permissions.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	label - _string_ (Required) This should match the label you set in <add_permission()>.
	 * 	returnCurlHandle - _boolean_ (Optional) A private toggle that will return the CURL handle for the request rather than actually completing the request. This is useful for MultiCURL requests.
	 *
	 * Returns:
	 * 	<ResponseCore> object
 	 *
 	 * Examples:
 	 *
	 * See Also:
	 * 	AWS Method - http://docs.amazonwebservices.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/index.html?Query_QueryRemovePermission.html
	 * 	Related - <add_permission()>, <remove_permission()>, <generate_policy()>
	 */
	public function remove_permission($label, $returnCurlHandle = null)
	{
		if (!$opt) $opt = array();
		$opt['Label'] = $label;
		$opt['returnCurlHandle'] = $returnCurlHandle;
		return $this->authenticate('RemovePermission', $opt, $this->hostname);
	}


	/*%******************************************************************************************%*/
	// HELPER/UTILITY METHODS

	/**
	 * Method: get_queue_size()
	 * 	Retrieves the approximate number of messages in the queue.
	 *
	 * Access:
	 * 	public
	 *
	 * Parameters:
	 * 	queue_name - _string_ (Required) The name of the queue to perform the action on.
	 *
	 * Returns:
	 * 	_integer_ The Approximate number of messages in the queue.
 	 *
 	 * Examples:
 	 * 	example::sqs/6_get_queue_size.phpt:
 	 *
	 * See Also:
	 * 	Related - <get_queue_attributes()>
	 */
	public function get_queue_size($queue_name)
	{
		$opt = array();
		$opt['AttributeName'] = 'ApproximateNumberOfMessages';
		$response = $this->authenticate('GetQueueAttributes', $opt, $this->hostname . '/' . $queue_name);

		if ($response->isOK() === false)
		{
			throw new SQS_Exception("Could not get queue size for $queue_name: " . $response->body->Error->Code);
		}

		return (integer) $response->body->GetQueueAttributesResult->Attribute->Value;
	}
}
=======
	 * 	Sets an attribute of a queue. Currently, you can set only the VisibilityTimeout attribute for a
	 * 	queue.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$attribute - _ComplexList_ (Required) A list of attributes to set. A **required** ComplexList is an indexed array of ComplexTypes -- each of which must be set by passing a nested associative array with the following `Attribute`-prefixed entries as keys. `x`/`y`/`z` should be integers, starting at `1`.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $attribute parameter:
	 *	Name - _string_ (Optional) Hello World
	 *	Value - _string_ (Optional)
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function set_queue_attributes($queue_url, $attribute, $opt = null)
	{
		if (!$opt) $opt = array();

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'Attribute' => (is_array($attribute) ? $attribute : array($attribute))
		)));

		return $this->authenticate('SetQueueAttributes', $opt, $queue_url);
	}

	/**
	 * Method: change_message_visibility()
	 * 	The ChangeMessageVisibility action changes the visibility timeout of a specified message in a queue
	 * 	to a new value. The maximum allowed timeout value you can set the value to is 12 hours. This means
	 * 	you can't extend the timeout of a message in an existing queue to more than a total visibility
	 * 	timeout of 12 hours. (For more information visibility timeout, see Visibility Timeout in the Amazon
	 * 	SQS Developer Guide.)
	 *
	 * 	For example, let's say you have a message and its default message visibility timeout is 30 minutes.
	 * 	You could call ChangeMessageVisiblity with a value of two hours and the effective timeout would be
	 * 	two hours and 30 minutes. When that time comes near you could again extend the time out by calling
	 * 	ChangeMessageVisiblity, but this time the maximum allowed timeout would be 9 hours and 30 minutes.
	 *
	 * 	If you attempt to set the VisibilityTimeout to an amount more than the maximum time left, Amazon
	 * 	SQS returns an error. It will not automatically recalculate and increase the timeout to the maximum
	 * 	time remaining.
	 *
	 * 	Unlike with a queue, when you change the visibility timeout for a specific message, that timeout
	 * 	value is applied immediately but is not saved in memory for that message. If you don't delete a
	 * 	message after it is received, the visibility timeout for the message the next time it is received
	 * 	reverts to the original timeout value, not the value you set with the ChangeMessageVisibility
	 * 	action.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$receipt_handle - _string_ (Required) The receipt handle associated with the message whose visibility timeout the client wants to change.
	 *	$visibility_timeout - _integer_ (Required) The new value (in seconds) for the message's visibility timeout.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function change_message_visibility($queue_url, $receipt_handle, $visibility_timeout, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ReceiptHandle'] = $receipt_handle;
		$opt['VisibilityTimeout'] = $visibility_timeout;

		return $this->authenticate('ChangeMessageVisibility', $opt, $queue_url);
	}

	/**
	 * Method: create_queue()
	 * 	The CreateQueue action creates a new queue, or returns the URL of an existing one. When you request
	 * 	CreateQueue, you provide a name for the queue. To successfully create a new queue, you must provide
	 * 	a name that is unique within the scope of your own queues. If you provide the name of an existing
	 * 	queue, a new queue isn't created and an error isn't returned. Instead, the request succeeds and the
	 * 	queue URL for the existing queue is returned.
	 *
	 * 	If you provide a value for DefaultVisibilityTimeout that is different from the value for the
	 * 	existing queue, you receive an error.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_name - _string_ (Required) The name to use for the created queue.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	DefaultVisibilityTimeout - _integer_ (Optional) The visibility timeout (in seconds) to use for the created queue.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function create_queue($queue_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['QueueName'] = $queue_name;

		return $this->authenticate('CreateQueue', $opt, $this->hostname);
	}

	/**
	 * Method: remove_permission()
	 * 	The RemovePermission action revokes any permissions in the queue policy that matches the specified
	 * 	Label parameter. Only the owner of the queue can remove permissions.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$label - _string_ (Required) The identfication of the permission to remove. This is the label added with the AddPermission operation.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function remove_permission($queue_url, $label, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['Label'] = $label;

		return $this->authenticate('RemovePermission', $opt, $queue_url);
	}

	/**
	 * Method: get_queue_attributes()
	 * 	Gets one or all attributes of a queue. Queues currently have two attributes you can get:
	 * 	ApproximateNumberOfMessages and VisibilityTimeout.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	AttributeName - _string_|_array_ (Optional) A list of attributes to get. Pass a string for a single value, or an indexed array for multiple values..
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function get_queue_attributes($queue_url, $opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['AttributeName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'AttributeName' => (is_array($opt['AttributeName']) ? $opt['AttributeName'] : array($opt['AttributeName']))
			)));
			unset($opt['AttributeName']);
		}

		return $this->authenticate('GetQueueAttributes', $opt, $queue_url);
	}

	/**
	 * Method: add_permission()
	 * 	The AddPermission action adds a permission to a queue for a specific principal. This allows for
	 * 	sharing access to the queue.
	 *
	 * 	When you create a queue, you have full control access rights for the queue. Only you (as owner of
	 * 	the queue) can grant or deny permissions to the queue. For more information about these permissions,
	 * 	see Shared Queues in the Amazon SQS Developer Guide.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$label - _string_ (Required)
	 *	$account_id - _string_|_array_ (Required) The AWS account number of the principal who will be given permission. The principal must have an AWS account, but does not need to be signed up for Amazon SQS. Pass a string for a single value, or an indexed array for multiple values..
	 *	$action_name - _string_|_array_ (Required) The action the client wants to allow for the specified principal. Pass a string for a single value, or an indexed array for multiple values..
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function add_permission($queue_url, $label, $account_id, $action_name, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['Label'] = $label;

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'AWSAccountId' => (is_array($account_id) ? $account_id : array($account_id))
		)));

		// Required parameter
		$opt = array_merge($opt, CFComplexType::map(array(
			'ActionName' => (is_array($action_name) ? $action_name : array($action_name))
		)));

		return $this->authenticate('AddPermission', $opt, $queue_url);
	}

	/**
	 * Method: delete_queue()
	 * 	This action unconditionally deletes the queue specified by the queue URL. Use this operation WITH
	 * 	CARE! The queue is deleted even if it is NOT empty.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_queue($queue_url, $opt = null)
	{
		if (!$opt) $opt = array();

		return $this->authenticate('DeleteQueue', $opt, $queue_url);
	}

	/**
	 * Method: delete_message()
	 * 	The DeleteMessage action unconditionally removes the specified message from the specified queue.
	 * 	Even if the message is locked by another reader due to the visibility timeout setting, it is still
	 * 	deleted from the queue.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$receipt_handle - _string_ (Required) The receipt handle associated with the message to delete.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function delete_message($queue_url, $receipt_handle, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['ReceiptHandle'] = $receipt_handle;

		return $this->authenticate('DeleteMessage', $opt, $queue_url);
	}

	/**
	 * Method: send_message()
	 * 	The SendMessage action delivers a message to the specified queue.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$message_body - _string_ (Required) The message to send.
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function send_message($queue_url, $message_body, $opt = null)
	{
		if (!$opt) $opt = array();
		$opt['MessageBody'] = $message_body;

		return $this->authenticate('SendMessage', $opt, $queue_url);
	}

	/**
	 * Method: receive_message()
	 * 	Retrieves one or more messages from the specified queue, including the message body and message ID
	 * 	of each message. Messages returned by this action stay in the queue until you delete them. However,
	 * 	once a message is returned to a ReceiveMessage request, it is not returned on subsequent
	 * 	ReceiveMessage requests for the duration of the VisibilityTimeout. If you do not specify a
	 * 	VisibilityTimeout in the request, the overall visibility timeout for the queue is used for the
	 * 	returned messages.
	 *
	 * Access:
	 *	public
	 *
	 * Parameters:
	 *	$queue_url - _string_ (Required)
	 *	$opt - _array_ (Optional) An associative array of parameters that can have the keys listed in the following section.
	 *
	 * Keys for the $opt parameter:
	 *	AttributeName - _string_|_array_ (Optional) A list of attributes to get. Pass a string for a single value, or an indexed array for multiple values..
	 *	MaxNumberOfMessages - _integer_ (Optional) The maximum number of messages to return. Amazon SQS never returns more messages than this value but may return fewer. All of the messages are not necessarily returned.
	 *	VisibilityTimeout - _integer_ (Optional) The duration (in seconds) that the received messages are hidden from subsequent retrieve requests after being retrieved by a ReceiveMessage request.
	 *	returnCurlHandle - _boolean_ (Optional) A private toggle specifying that the cURL handle be returned rather than actually completing the request. This toggle is useful for manually managed batch requests.
	 *
	 * Returns:
	 *	_CFResponse_ A <CFResponse> object containing a parsed HTTP response.
	 */
	public function receive_message($queue_url, $opt = null)
	{
		if (!$opt) $opt = array();

		// Optional parameter
		if (isset($opt['AttributeName']))
		{
			$opt = array_merge($opt, CFComplexType::map(array(
				'AttributeName' => (is_array($opt['AttributeName']) ? $opt['AttributeName'] : array($opt['AttributeName']))
			)));
			unset($opt['AttributeName']);
		}

		return $this->authenticate('ReceiveMessage', $opt, $queue_url);
	}
}

>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
