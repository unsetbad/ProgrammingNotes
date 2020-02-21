<?php

# 静态延迟绑定

# 父类
class Human{
    public static $name = 'Human';
    public static function showName(){
        # 静态绑定
        echo self::$name,'<br/>';			# 编译时：Human::$name
        # 静态延迟绑定
        echo static::$name,'<br/>';			# 编译时：? ::$name
    }
}

# 子类
class Man extends Human{
    # 重写父类静态属性
    public static $name = 'Man';	# 静态属性因为存储在类内部，因此不会覆盖
}


Human::showName();


# 子类调用
Man::showName();