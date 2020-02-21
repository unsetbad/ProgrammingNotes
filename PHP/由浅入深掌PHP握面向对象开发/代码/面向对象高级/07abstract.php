<?php

# 抽象类abstract


# 抽象类
abstract class Human{

	# 普通方法
	public function show(){}

	# 抽象方法
	protected abstract function eat();
}

# 不能被实例化
# new Human();


# 继承抽象类
abstract class Woman extends Man{

	abstract public function makeup();
}


class Man extends Human{
	# 实现父类抽象方法
	public function eat(){}
}


$m = new Man();