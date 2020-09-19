<?php 

# 类成员
#
# 定义买家类：买家有姓名，有钱
class Buyer{
    # 属性声明
	# $name;				# 错误，类内部属性必须使用访问修饰限定符
    public $name;		# 正确：没有赋值
    public $money = 0;	# 正确：有赋值
    
    # 方法声明
    function display(){
        echo __CLASS__;	# 魔术常量，输出类名
    }
    
    # 类常量声明
    const BIG_NAME = 'BUYER';
}


# 实例化
$b = new Buyer();

# 属性操作：增删改查
echo $b->money;
$b->money = 10;
$b->eyes = 1;
unset($b->name);


# 方法操作：调用
$b->display();
# var_dump($b);
