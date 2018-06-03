<?php
require 'vendor/autoload.php';

echo '<pre>';

var_dump($_SERVER['HTTP_X_FORWARDED_FOR']);

var_dump($_SERVER['REMOTE_ADDR']);

echo '</pre><hr>', new http\ip;
