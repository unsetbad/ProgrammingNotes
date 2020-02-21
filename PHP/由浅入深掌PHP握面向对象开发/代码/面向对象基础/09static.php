<?php 


# 静态成员


class Saler{
	# 属性
    public $money = 0;
    public static $count = 0;	# 静态属性

    # 方法
    public static function showClass(){
    	echo Saler::$count;			# 可以访问
        echo __CLASS__;
    }

    public function showCount(){
        echo __METHOD__;
    }

    public static function testThis(){
    	# var_dump($this);				# 静态方法中不能使用$this
    }
}


# 静态属性
# echo Saler::$count;

# 静态方法
# Saler::showClass();


# 实例化
$s = new Saler();

echo $s->money;
# echo $s->count;			# 对象不能访问静态属性
echo $s::$count;			# 可以访问，不建议

$s->showClass();

$s->showCount();

# 类访问普通方法
# Saler::showCount();


Saler::testThis();