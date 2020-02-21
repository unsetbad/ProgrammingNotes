<?php

# 继承基本实现


class Human{

	public function show(){
		echo __METHOD__;
	}
}

# 子类继承
class Man extends Human{
	# 子类是个空类
}

# 实例化子类
$m = new Man();
$m->show();