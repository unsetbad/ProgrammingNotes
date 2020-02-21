<?php

# 对象克隆

class Saler{
  	# 属性
  	public $count;				
  	private $money;

  	# 克隆魔术方法
  	private function __clone(){
  		# var_dump($this);

  		echo __METHOD__;

  		# 修改对象
  		$this->money = 10;
  	}
}
# 实例化
$s1 = new Saler();
$s1->count = 1;

# 克隆
# $s2 = clone $s1;

# var_dump($s1,$s2);


# 修改
/*$s2->count = 2;
var_dump($s1,$s2);*/