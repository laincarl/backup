<?php
require  'medoo.php';
$database = new medoo([
// 必须配置项
    'database_type' => 'mysql',
    'database_name' => 'offer100',
    'server' => 'localhost',
    'username' => 'root',
//    hehesql
    'password' => 'hehesql',
    'charset' => 'utf8',
    
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

?>