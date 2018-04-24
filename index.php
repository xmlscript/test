<?php
require 'vendor/autoload.php';

die(http\request::url('http://www.zhihu.com/')->fetch()->body());
