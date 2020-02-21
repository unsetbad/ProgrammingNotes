<?php

# 接口成员规范


interface Human{
    # 接口常量
    const NAME = '人';
    # 接口抽象方法
    public function eat();
    public static function show();
    
    # 错误示例
    # public function go(){}				# 错误：接口中的方法必须为抽象
    # public $age;					    # 错误：接口中不能有属性
    # public static $count = 0;			# 错误：接口中不能有静态属性（成员属性）
    # protected function walk();			# 错误：接口方法必须为公有抽象方法
    
}


# 实现接口：实体类
class Man implements Human{

	# 不允许重写接口常量
	# const NAME = 'Man';

	# 必须实现接口中所有的抽象方法
	public function eat(){}
	# protected static function show(){}	# 接口方法实现时必须为public
	public static function show(){}
}

# 实现接口：抽象类
abstract class Woman implements Human{}