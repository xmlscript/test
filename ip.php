<?php
require 'vendor/autoload.php';

echo '<p>HTTP_X_FORWARDED_FOR: ', $_SERVER['HTTP_X_FORWARDED_FOR'];

echo '<p>REMOTE_ADDR: ', $_SERVER['REMOTE_ADDR'];


echo '<h3>真实IP</h3><p>', new http\ip('10.129.8.1');


echo '<hr><pre>';
var_dump($_SERVER);
