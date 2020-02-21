<?php


# 自定义自动加载：多个自动加载函数


function c_autoload($classname){
	echo __FUNCTION__,'<br>';
	if(!class_exists($classname)){
		# 内存不存在，尝试加载
		$file = $classname . '.php';
		if(file_exists($file)) include $file;
	}
}

function m_autoload($classname){
	echo __FUNCTION__,'<br>';
	if(!class_exists($classname)){
		# 内存不存在，尝试加载
		$file = $classname . '.php';
		if(file_exists($file)) include $file;
	}
}

# 注册
spl_autoload_register('c_autoload');
spl_autoload_register('m_autoload');

# 实例化不存在的类
# $a = new A();
$s = new Buyer();