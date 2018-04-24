<?php
require 'vendor/autoload.php';

die(http\request::url('http://www.baidu.com/')->fetch()->body());
