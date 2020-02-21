<?php 


# 空间引入
namespace space;

function display(){
	echo __NAMESPACE__,'<br>';
}
class Man{}
const PI = 3.14;

class Woman{}
class Ladyboy{}


# 另外空间（另外文件）
namespace space1;

const PI = 3;

# 直接使用：完全限定名称
/*$m1 = new \space\Man();
var_dump($m1);*/

# 元素引入（类）
# use space\Man;
/*use \space\Man;

new Man();*/

# 引入函数
/*use function space\display;
display();
*/
# 引入常量
# use const space\PI;
# 元素别名
/*use const space\PI as P;
echo PI;
echo P;*/


# 批量引入元素
/*use space\Woman as W,space\Ladyboy as L;

new W();
new L();*/


# 引入空间
use space;
# 相当于将引入的空间的末级空间当做当前空间的子空间

# 因为引入是当做子空间：所以需要使用限定名称访问
# display();	# 错误：空间引入不是将空间元素全部纳入到当前空间里

# 正确访问
space\display();