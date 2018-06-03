<?php
require 'vendor/autoload.php';

echo '<p>HTTP_X_FORWARDED_FOR: ', $_SERVER['HTTP_X_FORWARDED_FOR'];

echo '<p>REMOTE_ADDR: ', $_SERVER['REMOTE_ADDR'];


echo '<h3>真实IP</h3><mark>', new http\ip('10.129.6.1'), '</mark>';


echo '<h3>ENV</h3><pre>';
var_dump($_ENV);
