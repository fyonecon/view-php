<?php
/*
 * 公共配置
 * */
namespace common;

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

$page_file = [ // 公共js、css
    'head_js'=> [
        $file_url.'static/js/all.js?'.$file_time,
    ],
    'head_css'=> [
        $file_url.'static/css/all.css?'.$file_time,
    ],
    'foot_js'=> [
        $file_url.'static/js/foot.js?'.$file_time,
    ],
];
