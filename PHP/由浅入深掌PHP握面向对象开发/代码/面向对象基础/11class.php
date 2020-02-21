<?php


# 需要使用Saler类

# 手动加载类
# include 'Saler.php';	# 直接加载比较消耗资源（如果类已经在内存存在，直接include会报错）

class Saler{
	public function __construct(){
		echo 'inner class';
	}
}

# 判定之后再考虑加载
if(!class_exists('Saler')){
	# 加载类（内存不存在）
	include 'Saler.php';
}

# 实例化
$s = new Saler();