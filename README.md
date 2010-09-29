<<<<<<< HEAD
# CloudFusion

Build awesome, cloud-based web applications in a fraction of the time!

## Requirements

* PHP 5.1.4 or newer (PHP 5.2+ recommended)
* SimpleXML extension
* cURL extension with SSL support

Caching support requires one or more of the following:

* *File:* Write permissions to the file system.
* *APC:* APC extension
* *XCache:* XCache extension
* *Memcache:* Memcached system service, Memcache PHP extension
* *SQLite:* PDO extension, PDO_SQLITE adapter, SQLite extension
* *MySQL:* PDO extension, PDO_MYSQL adapter, MySQL extension (or mysqlnd for PHP 5.3)
* *PostgreSQL:* PDO extension, PDO_PGSQL adapter, PGSQL extension

## Get the latest code

The following will pull down the latest development code, including CacheCore and RequestCore.

<pre><code>git clone git://github.com/skyzyx/cloudfusion.git
cd cloudfusion
git submodule init
git submodule update
</code></pre>

## Getting the hang of Git

As of early November 2009, CloudFusion has moved to the Git SCM and GitHub for a code repository.

### Mac

Mac users can install Git either from [the installer](http://code.google.com/p/git-osx-installer/downloads/list?can=3) or via [MacPorts](http://macports.org). If installing via MacPorts, I'd recommend calling `sudo port install git-core +svn`.

### Windows

Windows users can install [msys-git](http://code.google.com/p/msysgit/) or [TortoiseGit](http://code.google.com/p/tortoisegit/). [Getting started with Git and Github on Windows](http://kylecordes.com/2008/04/30/git-windows-go/) would be a good place to start.

### Linux

Depending on your flavor of Linux you can likely either use `yum` or `apt-get` to install the Git package.

## Contributing

I want to see CloudFusion become a community project. If you have a patch for a bug or new feature, fork CloudFusion, make the updates, then send me a Github pull request. This makes patching much easier.

It's even better when it's unit tested. Bug fix patches should include matching [PHPT](http://qa.php.net/write-test.php) unit tests, and new features should include unit tests and documentation in [NaturalDocs](http://naturaldocs.org) format.

Documentation is equally as important as the code itself, and unit tests are actually used for code samples within the documentation. Doing your best will make my job easier. :)

I definitely need help with:

* Writing PHPT tests for the S3 class
* Writing PHPT tests for the EC2 class
* Supporting the new EC2-related services that have come out in the past few months

## Links

* [Main site](http://getcloudfusion.com)
* [API reference](http://getcloudfusion.com/docs/latest)
* [Tutorials and screencasts](http://getcloudfusion.com/docs)
* [Discussion and support list](http://getcloudfusion.com/discussion)
* Donate! -- Click the little "Donate" button in the upper-right corner

## License

Code is BSD licensed. Documentation and tutorials are Creative Commons licensed. You can find exact details in the footer of the main site.
=======
# AWS SDK for PHP

The AWS SDK for PHP enables developers to build solutions for Amazon Simple Storage Service (Amazon S3),
Amazon Elastic Compute Cloud (Amazon EC2), Amazon SimpleDB, and more. With the AWS SDK for PHP, developers
can get started in minutes with a single, downloadable package.

The SDK features:

* **AWS PHP Libraries:** Build PHP applications on top of APIs that take the complexity out of coding directly
  against a web service interface. The toolkit provides APIs that hide much of the lower-level implementation.
* **Code Samples:** Practical examples for how to use the toolkit to build applications.
* **Documentation:** Complete SDK reference documentation with samples demonstrating how to use the SDK.
* **PEAR package:** The ability to install the AWS SDK for PHP as a PEAR package.
* **SDK Compatibility Test:** Includes both an HTML-based and a CLI-based SDK Compatibility Test that you can
  run on your server to determine whether or not your PHP environment meets the minimum requirements.

For more information about the AWS SDK for PHP, including a complete list of supported services, see
[aws.amazon.com/sdkforphp](http://aws.amazon.com/sdkforphp).


## Signing up for Amazon Web Services

Before you can begin, you must sign up for each service you want to use.

To sign up for a service:

* Go to the home page for the service. You can find a list of services on
  [aws.amazon.com/products](http://aws.amazon.com/products).
* Click the Sign Up button on the top right corner of the page. If you don't already have an AWS account, you
  are prompted to create one as part of the sign up process.
* Follow the on-screen instructions.
* AWS sends you a confirmation e-mail after the sign-up process is complete. At any time, you can view your
  current account activity and manage your account by going to [aws.amazon.com](http://aws.amazon.com) and
  clicking "Your Account".


## Source
The source tree for includes the following files and directories:

* `_compatibility_test` -- Includes both an HTML-based and a CLI-based SDK Compatibility Test that you can
  run on your server to determine whether or not your PHP environment meets the minimum requirements.
* `lib` -- Contains any third-party libraries that the SDK depends on. The licenses for these projects will
  always be Apache 2.0-compatible.
* `services` -- Contains the service-specific classes that communicate with AWS. These classes are always
  prefixed with `Amazon`.
* `utilities` -- Contains any utility-type methods that the SDK uses. Includes extensions to built-in PHP
  classes, as well as new functionality that is entirely custom. These classes are always prefixed with `CF`.
* `CHANGELOG`, `CONTRIBUTORS`, `LICENSE`, `NOTICE`, `README` -- File names that are all-caps are informational
  documents; the contents of which should be fairly self-explanatory.
* `config-sample.inc.php` -- A sample configuration file that should be filled out and renamed to `config.inc.php`.
* `sdk.class.php` -- The SDK loader that you would include in your projects. Contains the base functionality
  that the rest of the SDK depends on.


## Minimum Requirements in a nutshell

* You are at least an intermediate-level PHP developer and have a basic understanding of object-oriented PHP.
* You have a valid AWS account, and you've already signed up for the services you want to use.
* PHP 5.2 or newer (5.2.14 or latest 5.3.x highly recommended)
* [SimpleXML](http://php.net/simplexml) extension
* [JSON](http://php.net/json) (JavaScript Object Notation) extension
* [PCRE](http://php.net/pcre) (Perl-Compatible Regular Expressions) extension
* [SPL](http://php.net/spl) (Standard PHP Library) extension
* [cURL](http://php.net/curl) extension (compiled with [OpenSSL](http://openssl.org) for HTTPS support)
* Ability to write to the file system

We've included an [SDK Compatibility Test](http://github.com/amazonwebservices/aws-sdk-for-php/tree/master/_compatibility_test/)
that you can run to determine whether or not your PHP environment meets the minimum requirements.


## Installation

### Via GitHub

Amazon Web Services publishes releases of the AWS SDK for PHP to [GitHub](http://github.com/amazonwebservices),
which is a hosted service for [Git](http://git-scm.com) repositories.

If you're unfamiliar with Git, there are a variety of resources on the net that will help you learn more:

* [Everyday Git](http://www.kernel.org/pub/software/scm/git/docs/everyday.html) will teach you just enough
  about Git to get by.
* The [PeepCode screencast](https://peepcode.com/products/git) on Git ($9) is easier to follow.
* [GitHub](http://github.com/guides/home) offers links to a variety of Git resources.
* [Pro Git](http://progit.org/book/) is an entire book about Git with a Creative Commons license.
* [Git for the lazy](http://www.spheredev.org/wiki/Git_for_the_lazy) is a great mini-reference to remind you
  how to do things.
* If you want to dig even further, I've bookmarked [other Git references](http://delicious.com/skyzyx/git).

Here's how you would check out the source code from GitHub:

	git clone git://github.com/amazonwebservices/aws-sdk-for-php.git AWSSDKforPHP
	cd ./AWSSDKforPHP

### Via PEAR

Amazon Web Services also publishes releases of the AWS SDK for PHP to a self-hosted
[PEAR repository](http://pear.amazonwebservices.com).

If you're unfamiliar with how to install PEAR packages, check out
[Command line installer](http://pear.php.net/manual/en/guide.users.commandline.cli.php) in the PEAR user guide.

	sudo pear channel-discover pear.amazonwebservices.com
	sudo pear install aws/sdk

### Configuration

1. Copy the contents of [config-sample.inc.php](https://github.com/amazonwebservices/aws-sdk-for-php/raw/master/config-sample.inc.php)
   and add your credentials as instructed in the file.
2. Move your file to `~/.aws/sdk/config.inc.php`.
3. Make sure that `getenv('HOME')` points to your user directory. If not you'll need to set
   `putenv('HOME=<your-user-directory>')`.


## Additional Information

* AWS SDK for PHP: <http://aws.amazon.com/sdkforphp>
* PHP Developer Center: <http://aws.amazon.com/php>
* Documentation: <http://docs.amazonwebservices.com/AWSSDKforPHP/latest/>
* License: <http://aws.amazon.com/apache2.0/>
* Discuss: <http://aws.amazon.com/forums>
>>>>>>> f89d276c08923c32850e8d991a1f67c0cc2e13cb
