<?php
/*
 * 公共配置
 * */
namespace config;
require_once 'config/common.php';   // 自定义的公共函数

$config = [

    'api_url' => '', // api主地址
    'web_url' => './?', // 页面主地址
    'file_url' => './', // 文件主地址

    'php_debug' => true,
    'time'=> ceil(time()/1000)*1000, // 默认缓存1000s
    'page_time'=> time(),

    'route'=> 'route', // 页面路由名称
    'route_default'=> 'home', // 页面默认路由

];

$route = $config["route"];
$route_url = $config['web_url'].$route.'=';
$file_url = $config['file_url'];
$file_time = $config['time'];
$time_config = ceil(time()/100)*100; // 模块文件缓存100s

$page_file = [ // 公共js、css
    'head_js'=> [
        '/js/all.js',
    ],
    'head_css'=> [
        '/css/all.css',
    ],
    'foot_js'=> [
        '/js/foot.js',
    ],
];
