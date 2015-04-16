FoodOrder
====================

install
----------------------

0. The URL of FoodOrder is : "https://github.com/Salon-sai/learnlaravel"
	个FoodOrder噶URL系呢个："https://github.com/Salon-sai/learnlaravel"

1. After cloning by git, you must use command : "composer update". The Project will autoload the dependent plug it need.
   使用git之后，你用"composer update"，自动下载项目需要噶插件

2. You must give the permission to access of the bootstrap and vender files, if you use the linux system
   如果你使用linux系统，必须更改bootstrap 同 vender 目录噶权限。

3. open the file "app/config/database.php". You can change the configuration of database in order to satisfy your nessacessary.
   打开“app/config/database.php”文件。你可以根据自己情况修改数据库连接参数。

3. using the comand "php artisan migrate --package=cartalyst/sentry", the Sentry will install the table in your database.
   使用"php artisan migrate --package=cartalyst/sentry"，Sentry插件会自动安装插件需要噶表到数据库。

4. using "php artisan migrate", migration will generate the table OA-System need into your database.
   使用"php artisan migrate",项目会将自身需要的数据库表加载到数据库

3. use the command "php artisan serve" to start the system with the php server.
   使用"php artisan serve"开启测试项目，假如用apache或者nginx噶话，可以上laravel噶官网睇睇个配置啦~呢度唔多讲啦


supervisord
----------------------
1. 生成配置文件
$ echo_supervisord_conf > /etc/supervisord.conf

2.修改配置文件
vi /etc/supervisord.conf




