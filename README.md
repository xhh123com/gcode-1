# gcode

gcode目前是用于快速生成标准化文件的工具，目前支持Models和Components的生成，通过编写.env文件，设置好数据库后，就可以快速生成Models和Components的文件

后续还将自动生成Controller、路由等

# 使用方法

1、下载gcode，并且配置.env文件，其中配置数据库连接信息即可，希望生成哪个数据库的Models和Components，即配置哪个数据库

* DB_CONNECTION：数据库连接（一般不需要修改）
* DB_HOST：数据库地址
* DB_PORT：数据库端口（一般不需要修改）
* DB_USERNAME：数据库用户名
* DB_PASSWORD：数据库密码

```

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

```

2、执行php artisan命令，核心创建文件的代码在app/Console/Commands/CreateFiles.php中

配置的命令为 php artisan auto:createFiles ，在命令行中执行该命令，则将自动运行，运行日志如下

```
manager_name:UserQdManager

columns:
["id","user_id","phonenum","jifen","created_at","updated_at","deleted_at"]

model code string:
<html>


/**
 * Created by PhpStorm.
 * User: mtt17
 * Date: 2018/4/9
 * Time: 11:32
```


3、正确运行后，将在/storage/app/Code文件夹下生成：

* Models文件夹，其中是Model
* Components文件夹，其中是Manager
* Admin，其中是Controller，管理后台的Controller
* Api文件夹，其中是Controller，接口的Controller
* Route文件夹，其中是web和api的路由

4、参考其他项目，将Models和Components拷贝到app目录下，完成项目基本信息建设


@欢迎团队小伙伴协助进行项目优化，或者在使用中感觉需要哪些公共的类要生成，也可以补充或者新建命令


2019年5月6日进行优化，默认建立数据库时utf8字符集的，在处理用户昵称时，如果有emoj符号就会报错，因此需要手动连接数据库，执行修改字符集的命令。进行gcode的优化，在DB文件夹下，生成alertCharset.txt文件，其中的代码是修改数据库字符集的代码，应该执行。


