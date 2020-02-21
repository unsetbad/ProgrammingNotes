<?php 


# 系统元素寻找
namespace space;

function display(){
	echo __NAMESPACE__,'space空间<br>';
}

# 访问系统函数
# echo count([1,2,3]);		# 系统函数和常量，系统会自动升级到全局空间找
# echo \count([1,2,3]);


# 访问系统类
# new stdClass();			# 错误：系统类，系统不会升级去全局空间找

# new \stdClass();


# 包含全局空间文件 （没空间）
include '28namespace_global.php';

# 虽然包含的文件右空间，但是不影响包含之后的后序代码的非限定名称访问
display();


# 想要访问被包含文件里的元素（带空间）：根据被包含文件的空间形式来实现
# 如果被包含文件是全局空间：那么使用完全限定名称访问
\display();
