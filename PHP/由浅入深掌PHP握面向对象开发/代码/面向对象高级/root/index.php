<?php

# root目录下的文件

# 啥都不用做，直接包含controller文件
include_once 'controller/User.php';

$u = new controller\User();				# 等价于new \controler\User()
$u->display();