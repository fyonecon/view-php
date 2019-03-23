<?php
/*
 * 自定义的全局公共函数
 * 服务于模块
 * */
use depend\view;

require VIEW_PATH.'config/config.php';
$_route_encode = $route_encode;

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
    global $_route_encode;

   if ($_route_encode == true){
       $view = new view();
       return $view->string_encode($route);
   }else{
       return $route;
   }

}

/*
 * 解密route
 * */
function route_decode($route){
    global $_route_encode;

    if ($_route_encode == true){
        $view = new view();
        return $view->string_decode($route);
    }else{
        return $route;
    }

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

// 两个键值相等时的去重
// 专用于数据库查出来的数组
function group_arrays($info, $key1, $key2){

    $have = [];
    $array = [];
    $index = [];

    for($m=0; $m<count($info); $m++){
        $has1 = $info[$m][$key1];
        $has2 = $info[$m][$key2];

        if (in_array([$has1=>$has2], $array)){
            // 存在则跳过
        }else{
            $array[] = [$has1=>$has2];
            $index[] = $m;
        }
    }

    foreach ($index as $value){
        $have[] = $info[$value];
    }

    return $have;
}

// 一个键值相等时的去重
function group_array($info, $db_key){

    $have = [];
    $array = [];
    for($m=0; $m<count($info); $m++){
        $has_id = $info[$m][$db_key];
        $array[] = $has_id;
    }
    $array = array_unique($array); // 返回 索引键=>id
    foreach ($array as $key=>$value){
        $have[] = $info[$key];
    }

    return $have;
}
