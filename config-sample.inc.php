<<<<<<< HEAD
<?php
/**
 * File: Configuration
 * 	Stores your AWS account information. Add your account information, then rename this file to 'config.inc.php'.
 *
 * Version:
 * 	2010.01.19
 *
 * Copyright:
 * 	2006-2010 Ryan Parman, Foleeo, Inc., and contributors.
 *
 * License:
 * 	Simplified BSD License - http://opensource.org/licenses/bsd-license.php
 *
 * See Also:
 * 	CloudFusion - http://getcloudfusion.com
=======
<?php if (!class_exists('CFRuntime')) die('No direct access allowed.');
/**
 * File: Configuration
 * 	Stores your AWS account information. Add your account information, and then rename this file to 'config.inc.php'.
 *
 * Version:
 * 	2010.08.23
 *
 * License and Copyright:
 * 	See the included NOTICE.md file for more information.
 *
 * See Also:
 * 	[PHP Developer Center](http://aws.amazon.com/php/)
 * 	[AWS Security Credentials](http://aws.amazon.com/security-credentials)
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
 */


/**
 * Constant: AWS_KEY
<<<<<<< HEAD
 * 	Amazon Web Services Key. <http://aws-portal.amazon.com/gp/aws/developer/account/index.html?action=access-key>
=======
 * 	Amazon Web Services Key. Found in the AWS Security Credentials.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
 */
define('AWS_KEY', '');

/**
 * Constant: AWS_SECRET_KEY
<<<<<<< HEAD
 * 	Amazon Web Services Secret Key. <http://aws-portal.amazon.com/gp/aws/developer/account/index.html?action=access-key>
=======
 * 	Amazon Web Services Secret Key. Found in the AWS Security Credentials.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
 */
define('AWS_SECRET_KEY', '');

/**
 * Constant: AWS_ACCOUNT_ID
<<<<<<< HEAD
 * 	Amazon Account ID without dashes. Used for identification with Amazon EC2. <http://aws-portal.amazon.com/gp/aws/developer/account/index.html?action=access-key>
=======
 * 	Amazon Account ID without dashes. Used for identification with Amazon EC2. Found in the AWS Security Credentials.
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
 */
define('AWS_ACCOUNT_ID', '');

/**
<<<<<<< HEAD
 * Constant: AWS_ASSOC_ID
 * 	Amazon Associates ID. Used for crediting referrals via Amazon AAWS. <http://affiliate-program.amazon.com/gp/associates/join/>
 */
define('AWS_ASSOC_ID', '');

/**
 * Constant: AWS_DEFAULT_LOCALE
 * 	Locale that all PAS methods should default to. Can be overridden per-instance. Valid values are 'us', 'uk', 'ca', 'fr', 'de', or 'jp'.
 */
define('AWS_DEFAULT_LOCALE', '');

/**
 * Constant: AWS_CANONICAL_ID
 * 	Your CanonicalUser ID. Used for setting access control settings in AmazonS3. Must be fetched from the server. Call <?php print_r($s3->get_canonical_user_id()); ?> to view.
 */
define('AWS_CANONICAL_ID', '');

/**
 * Constant: AWS_CANONICAL_NAME
 * 	Your CanonicalUser DisplayName. Used for setting access control settings in AmazonS3. Must be fetched from the server. Call <?php print_r($s3->get_canonical_user_id()); ?> to view.
 */
define('AWS_CANONICAL_NAME', '');
=======
 * Constant: AWS_CANONICAL_ID
 * 	Your CanonicalUser ID. Used for setting access control settings in AmazonS3. Found in the AWS Security Credentials.
 */
define('AWS_CANONICAL_ID', '');

/**
 * Constant: AWS_CANONICAL_NAME
 * 	Your CanonicalUser DisplayName. Used for setting access control settings in AmazonS3. Found in the AWS Security Credentials (i.e. "Welcome, AWS_CANONICAL_NAME").
 */
define('AWS_CANONICAL_NAME', '');

/**
 * Constant: AWS_MFA_SERIAL
 * 	12-digit serial number taken from the Gemalto device used for Multi-Factor Authentication. Ignore this if you're not using MFA.
 */
define('AWS_MFA_SERIAL', '');

/**
 * Constant: AWS_CLOUDFRONT_KEYPAIR_ID
 * 	Amazon CloudFront key-pair to use for signing private URLs. Found in the AWS Security Credentials.
 */
define('AWS_CLOUDFRONT_KEYPAIR_ID', '');

/**
 * Constant: AWS_PRIVATE_KEY_PEM
 * 	The contents of the *.pem private key that matches with the CloudFront key-pair ID. Found in the AWS Security Credentials.
 */
define('AWS_CLOUDFRONT_PRIVATE_KEY_PEM', '');

/**
 * Constant: AWS_ENABLE_EXTENSIONS
 * 	Set the value to true to enable autoloading for classes not prefixed with "Amazon" or "CF". If enabled, load sdk.class.php last to avoid clobbering any other autoloaders.
 */
define('AWS_ENABLE_EXTENSIONS', 'false');
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
