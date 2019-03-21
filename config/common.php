<?php
/*
 * 自定义的全局公共函数
 * */
use depend\view;


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

/*
 * 加密route
 * */
function route_encode($route){
    $view = new view();
    return $view->string_encode($route);
}

/*
 * 解密route
 * */
function route_decode($route){
    $view = new view();
    return $view->string_decode($route);
}

/*
 * 返回/?route=xxx，方便在页面中引用和管理
 * */
function route_string($route_string = ''){
    return ROUTE_URL.route_encode($route_string);
}

/*
 * 解析url中的参数
 * 根据键获取值
 * */
function getThisUrlParam($url, $key){
    $view = new view();
    return $view->getThisUrlValue($url, $key);
}

/*
 * 404
 * */
function state_404($txt = '页面未找到。'){
    $view = new view();
    $view->back_404($txt);
}

/*
 * 403
 * */
function state_403($txt = '地址不对，拒绝访问。'){
    $view = new view();
    $view->back_403($txt);
}


