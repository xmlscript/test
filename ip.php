<?php
require 'vendor/autoload.php';

echo '<p>HTTP_X_FORWARDED_FOR: <mark>', $_SERVER['HTTP_X_FORWARDED_FOR'], '</mark>';

echo '<p>REMOTE_ADDR: <mark>', $_SERVER['REMOTE_ADDR'], '</mark>';


echo '<p>真实IP: <mark>', new http\ip('10.129.6.1', '10.129.8.1'), '</mark>';



echo '<h3>ENV</h3><pre>';
var_dump($_ENV);
