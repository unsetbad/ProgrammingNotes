<?php

# self关键字


class Buyer{
    # 静态属性
    private static $count = 0;			# 私有，不允许外部直接访问
	# 静态方法
    public static function showClass(){
        # echo Saler::$count;

        echo self::$count;				# 代替类名
    }

    # 私有化构造方法
    private function __construct(){}

    # 提供静态方法：实现对象实例化
    public static function getInstance(){
    	# return new Saler();
    	# 可以使用self代替类名进行内部实例化
    	return new self();
    }
}

# Saler::showClass();


# 实例化对象
# new Saler();
# 

# 获取实例
$s = Buyer::getInstance();
var_dump($s);