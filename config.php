<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('DSN', 'mysql:dbname=php_lesson;host=localhost;unix_socket=/tmp/mysql.sock');
define('DB_USER', 'root');
define('DB_PASSWORD', 'ttschool'); // 各自で設定しているMySQLのパスワードを第二引数に入力して下さい