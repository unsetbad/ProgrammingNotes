<?php

# __autoload实现自动加载


# 自动加载
function __autoload($a){

	# echo $a;				# 形参代表类名 

	# 实现类的加载
	# include 'Buyer.php';
	# 动态加载
	$file = $a . '.php';

	if(!class_exists($file)) include $a . '.php';
		
}


# 使用类
$b = new Buyer();
$s = new Saler();
$s2 = new Saler();