<?php

# 全局空间



function display(){
	echo __NAMESPACE__,'全局空间<br>';
}

# 非限定名称访问：访问当前空间的元素
# display();


# 完全限定名称访问
# \display();


# 访问系统函数
# echo count([1,2,3]);
# echo \count([1,2,3]);
