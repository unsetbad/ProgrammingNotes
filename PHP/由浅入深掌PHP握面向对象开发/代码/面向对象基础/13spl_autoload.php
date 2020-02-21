<?php

# 利用自定义函数注册自动加载机制


# 自定义函数实现加载类
function my_autoload($classname){

	# 直接加载
	
	if(!class_exists($classname)){
		# 内存不存在，尝试加载
		$file = $classname . '.php';
		if(file_exists($file)) include $file;
	}
}

# 将自定义函数注册到自动加载机制中：让自动加载能够执行
spl_autoload_register('my_autoload');


# 实例化类
$s = new Saler();
$b = new Buyer();
$a = new A();