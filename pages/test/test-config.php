<?php
/*
 * 模块中的配置
 * */

$title = 'test-页面'; // title标题称呼
$time_config = ceil(time()/100)*100; // 模块文件缓存100s

$route_file = [ // 页面模块js、css，放在该模块目录下
    'js'=>[
        'test.js?'.$time_config,
    ],
    'css'=>[
        'test.css?'.$time_config,
    ],
];
