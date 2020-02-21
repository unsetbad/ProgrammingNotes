<?php

# 对象传值

class Saler{}


$s1 = new Saler();
$s2 = $s1;


$s1->name = 'Saler';

var_dump($s1,$s2);