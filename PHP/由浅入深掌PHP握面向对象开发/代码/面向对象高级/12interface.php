<?php

# 接口interface


# 定义接口
interface Human{}

# 接口不能实例化
# new Human();


# 实现接口
class Man implements Human{}

# 实例化
$m = new Man();