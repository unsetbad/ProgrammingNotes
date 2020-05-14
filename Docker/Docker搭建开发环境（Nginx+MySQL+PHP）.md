### 注意事项

> 1、像MySQL配置文件、Nginx配置文件、网站根目录这种比较经常操作的需要先使用 `docker cp` 将文件从容器里复制到主机目录，`docker run`的时候直接挂载目录就可以了
>
> 2、`docker run` MySQL和Nginx的时候注意使用 `--link`实现容器之间通信
>
> 3、运行容器的时候注意使用 `--ip` 固定容器IP

### 安装 MySQL

#### mysql 需要挂载的目录

```bash
/var/lib/mysql
/etc/mysql/conf.d
```

#### 挂载详情

```bash
# 主机目录:容器目录
~/web/mysql/data:/var/lib/mysql 
~/web/mysql/conf:/etc/mysql/conf.d 
```

#### 文件备份

将mysql的配置文件，自带数据库，sock配置 复制到主机目录

```bash
# docker cp container_ID:容器目录 主机目录
docker cp 2d19ae0acd5d:/var/lib/mysql ~/web/mysql/data
docker cp 2d19ae0acd5d:/etc/mysql/conf.d  ~/web/mysql/conf
```

#### 目录分解

```bash
docker run 
--name mysql # 指定容器名称
-e MYSQL_ROOT_PASSWORD=root  # 初始化root用户的密码为root
-p 3307:3306 # 将容器的3306端口映射到主机的3307端口
--privileged=true # 给容器加上特定的权限，否则可能会出现常见容器失败的情况
-v ~/web/mysql/data:/var/lib/mysql # 挂载目录 mysql数据文件
-v ~/web/mysql/conf:/etc/mysql/conf.d # 挂载目录 mysql配置文件
--restart=always # 设置失败自动重启   可写为 --restart=on-failure:5  最多重启五次
-d mysql:5.7
```

#### 命令实现

```bash
docker run --name mysql -e MYSQL_ROOT_PASSWORD=root -p 3307:3306 --privileged=true -v ~/web/mysql/data:/var/lib/mysql -v ~/web/mysql/conf:/etc/mysql/conf.d --restart=always -d mysql:5.7
```



### 安装PHP

#### 需要挂载的目录

```bash
/var/www/html 
```

#### 挂载详情

```bash
# 主机目录:容器目录
~/web/www/:/var/www/html 
```

#### 文件备份

```bash
# docker cp container_ID:容器目录 主机目录
docker cp 7da668050b8a:/var/www/html /docker-data/web/www
```

#### 目录分解

```bash
docker run 
--name php 
-p 9000:9000 
--privileged=true 
-v ~/web/www/:/wwwroot 
--link mysql:mysql # 使用link实现两个容器之间的通信
--restart=always 
-d
php:7.2-fpm
```

#### 命令实现

```bash
docker run --name php -p 9000:9000 --privileged=true -v ~/web/www/:/wwwroot --link mysql:mysql --restart=always -d php:7.2-fpm
```

#### 扩展安装

```bash
# 进入容器执行命令安装扩展
docker-php-ext-install [扩展名称]

# 安装GD库
apt update  #更新软件源
apt install -y libwebp-dev libjpeg-dev libpng-dev libfreetype6-dev #安装各种库
docker-php-source extract #解压源码
cd /usr/src/php/ext/gd  #gd源码文件夹
docker-php-ext-configure gd --with-webp-dir=/usr/include/webp --with-jpeg-dir=/usr/include --with-png-dir=/usr/include --with-freetype-dir=/usr/include/freetype2   #准备编译
docker-php-ext-install gd   #编译安装
php -m | grep gd
docker restart [container ID]#重启容器
```



### 安装Nginx

#### 需要挂载的目录

```bash
/usr/share/nginx/html 
/etc/nginx/conf.d 
```

#### 挂载详情

```bash
# 主机目录:容器目录
~/web/www:/usr/share/nginx/html 
~/web/nginx/conf.d:/etc/nginx/conf.d 
```

#### 文件备份

```bash
# docker cp container_ID:容器目录 主机目录
docker cp e0babc8a32ad:/usr/share/nginx/html ~/web/www
docker cp e0babc8a32ad:/etc/nginx/conf.d ~/web/nginx/conf.d
```

#### 目录分解

```bash
docker run 
--name nginx 
-p 8080:80  
--privileged=true 
-v ~/web/www:/wwwroot
-v ~/web/nginx/conf.d:/etc/nginx/conf.d 
--link php:php 
--restart=always 
-d 
nginx
```

#### 命令实现

```bash
docker run --name nginx -p 8080:80  --privileged=true -v ~/web/www:/wwwroot -v ~/web/nginx/conf.d:/etc/nginx/conf.d --link php:php --restart=always -d nginx
```

### Nginx配置文件参考

```bash
server {
        listen       80;
        server_name  tplay.yulongcode.com;

        root   /wwwroot/tplay/public; # 项目在容器里的目录
        index index.php index.html index.htm;

        location / {
            if (!-e $request_filename){
                   rewrite  ^(.*)$  /index.php?s=$1  last;   break;
            }
        }

        error_page   500 502 503 504  /50x.html;
     
        location ~ \.php$ {
            fastcgi_pass   PHP容器IP:PHP端口;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME   $document_root$fastcgi_script_name;
            include        fastcgi_params;
	   }
}
```