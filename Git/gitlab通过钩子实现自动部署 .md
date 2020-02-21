> 功能：本地往服务器推送代码之后，触发web钩子，服务器拉取刚刚推送的代码

## 步骤
### 1. 在gitlab后台配置钩子
项目-》编辑项目-》Web钩子-》新增钩子

### 2.在服务器端为www用户生成公钥  
生成公钥
```ssh-keygen -t rsa -C "登录gitlab的邮箱"```
查看公钥
```cat ~/.ssh/id_rsa.pub```
复制公钥，前往gitlab的项目设置，将公钥添加进去

### 3.在服务器端首先使用git pull将项目拉取一遍
使用`git pull`先将代码拉取下来
### 4.更改项目的git配置文件
在项目的根目录`vim ./.git/config`，将里面的配置项url的值改为项目仓库的ssh链接（不要使用http链接）
### 5.在项目根目录写hooks.php文件
hooks.php参考：
```php
<?php
	$fs = fopen('./git_hook.log', 'a');
	fwrite($fs, 'Request on ['.date("Y-m-d H:i:s").']'.PHP_EOL);
	$json = file_get_contents('php://input');
	$data = json_decode($json, true);
	fwrite($fs, 'Data: '.print_r($data, true).PHP_EOL);
	fwrite($fs, '======================================================================='.PHP_EOL);
	$res = exec("cd 项目根目录 && git pull origin master 2<&1",$output);
    fwrite($fs,$res);
	exit;
?>
```
### 6.推送测试