--TEST--
AmazonSQS::cache_response CachePDO:SQLite

--FILE--
<?php
	require_once dirname(__FILE__) . '/../../cloudfusion.class.php';
	$sqs = new AmazonSQS();

	// First time pulls live data
	$response = $sqs->cache_response('list_queues', 'pdo.sqlite:./cache/sqlite.db', 10);
	var_dump($response->status);

	// Second time pulls from cache
	$response = $sqs->cache_response('list_queues', 'pdo.sqlite:./cache/sqlite.db', 10);
	var_dump($response->status);
?>

--EXPECT--
int(200)
int(200)