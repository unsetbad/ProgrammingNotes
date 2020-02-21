<?php

# 析构方法


class Saler{
  	# 析构方法
    public function __destruct(){
    	# 释放资源
        echo __FUNCTION__;
    }
}


# 实例化
$s = new Saler;


# 主动销毁
# $s = 1;
# unset($s);
# 
# 主动调用析构方法
$s->__destruct();


echo 'end';