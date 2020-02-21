<?php

# 单例模式

# 创建类
class Singleton{
	# 私有化构造方法：防止外部无限实例化对象
	private function __construct(){
		# 没有初始化需求的话，构造方法可以为空方法
	}

	# 静态属性：私有化，保存已经产生的对象
	private static $obj = NULL;

	# 公有静态方法：产生对象返回给外部调用者
	public static function getInstance(){
		# return new self();
		# 判定对象是否已经产生过
		if(!self::$obj instanceof self){
			# 没有产生对象
			self::$obj = new self();
		}

		# 返回静态属性保存的对象即可
		return self::$obj;
	}

	# 私有化克隆方法：防止外部进行对象克隆
	private function __clone(){}
}


# new Singleton();	# 错误
$s1 = Singleton::getInstance();
$s2 = Singleton::getInstance();

# $s3 = clone $s2;
var_dump($s1,$s2);