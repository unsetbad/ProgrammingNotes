<?php

# 接口多继承实例


# 顶级接口
interface Human{
    public function walk();
    public function talk();
}

interface Animal{
    public function eat();
    public function drink();
}

# 有物种有以上两种特性
interface Ape extends Human,Animal{
    public function sleep();
}

# 所有APE相关类应该实现Ape接口
class Monkey implements Ape{
    public function walk(){}
    public function talk(){}
    public function eat(){}
    public function drink(){}
    public function sleep(){}
}
