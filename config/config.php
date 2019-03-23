<?php
/*
 * 公共配置
 * 服务于模块和整个框架
 * */

// 自定义，系统参数配置
$config = [

    'api_url' => '',        // api主地址
    'web_url' => './?',     // 页面主地址
    'file_url' => './',     // 文件主地址

    // 'view_debug' => true,                           // 是否开启view debug
    'time'=> ceil(time()/1000)*1000,            // 默认缓存1000s
    'time_config'=> ceil(time()/100)*100,       // 模块文件缓存100s
    'page_time'=> time(),

    'route'=> 'route',          // 页面路由名称
    'route_default'=> 'home',   // 页面默认路由
    'robot'=> true,             // 是否屏蔽搜索引擎爬虫
    'old_php'=> true,           // PHP低版本从7.1.x开始
    'route_encode'=> false ,    // 是否开启路由加密

];

// 自定义，公用文件配置
$page_file = [ // 公共js、css，主目录为static
    'head_js'=> [
        'js/all.js',
    ],
    'head_css'=> [
        'css/all.css',
    ],
    'foot_js'=> [
        'js/foot.js',
    ],
];


// 以下不要修改
$route = $config["route"];
$route_default = $config['route_default'];
$route_url = $config['web_url'].$route.'=';
$file_url = $config['file_url'];
$file_time = $config['time'];
$time_config = $config['time_config'];
$robot_spider = $config['robot'];
$old_php = $config['old_php'];
$route_encode = $config['route_encode'];

