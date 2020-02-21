<?php

# 范围解析操作符
class Saler{
	# 类常量
    const PI = 3.14;
}


# $s1 = new Saler();
# echo $s1->PI;			# 无法访问


# 类访问类常量
echo Saler::PI;
# echo $s1::PI;			# 范围解析操作符兼容对象：找到对象所属类最终进行访问