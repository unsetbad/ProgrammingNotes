<?php


# 空间元素访问：非限定名称访问
namespace space1;

function display(){
	echo __NAMESPACE__,'<br>';
}

namespace space2;

function display(){
	echo __NAMESPACE__,'<br>';
}


# 非限定名称访问
# display();


# 定义子空间
namespace space\space1;
function display(){
    echo __NAMESPACE__,'<br>';
}

# 定义子空间
namespace space\space2;
function display(){
    echo __NAMESPACE__,'<br>';
}

# 所属父空间
namespace space;
function display(){
    echo __NAMESPACE__,'<br>';
}

# 非限定名称访问
# display();


# 限定名称  
# space1\display();          		# 等价于 space\space1\display()      
# 

# 完全限定名称访问
\space\display();    
\space1\display();  
\space\space2\display();                       