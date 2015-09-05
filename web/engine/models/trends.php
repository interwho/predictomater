<?php
require '../aws/aws-autoloader.php';
use Aws\DynamoDb\DynamoDbClient;

$client = DynamoDbClient::factory(array(
                                      'profile' => '<profile in your aws credentials file>',
                                      'region'  => '<region name>'
                                  ));
