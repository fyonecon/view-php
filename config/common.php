<?php
/*
 * 自定义的全局公共函数
 * */

/*
 * 获取服务器IP
 * */
function server_ip(){
    return $_SERVER['SERVER_ADDR'];
}

/*
 * 获取客户端IP
 * */
function user_ip(){
    return $_SERVER['REMOTE_ADDR'];
}

/*
 * 返回当前毫秒时间戳
 * */
function now_timestamp() {
    list($ms, $sec) = explode(' ', microtime());
    $time = (float)sprintf('%.0f', (floatval($ms) + floatval($sec)) * 1000);
    return $time;
}