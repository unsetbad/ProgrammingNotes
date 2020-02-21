<?php

# 最终类final

# 最终类
final class Man{

	# final类中没有必要再使用final关键字修饰方法
}


# 错误操作：final类不能被继承
# class Son extends Man{}
# 
# 
# 一般类：但是不允许某个方法被重写
class Human{

	public function beOverride(){

	}

	final public function notOverride(){

	}
}

class Woman extends Human{
	public function beOverride(){}

	# 重写final方法（父类）
	# public function notOverride(){}
}