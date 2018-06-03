<?php
require 'vendor/autoload.php';

echo '<p>HTTP_X_FORWARDED_FOR: <mark>', $_SERVER['HTTP_X_FORWARDED_FOR']??'NULL', '</mark>', PHP_EOL;

echo '<p>REMOTE_ADDR: <mark>', $_SERVER['REMOTE_ADDR'], '</mark>', PHP_EOL;


echo '<p>真实IP: <mark>', $obj=new http\ip('10.129.6.1', '10.129.8.1'), '</mark>', PHP_EOL;

die;


echo '<h3>$_SERVER</h3><pre>';
var_dump($_SERVER);

echo '<h3>ENV</h3><pre>';
var_dump($_ENV);
