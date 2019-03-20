<?php
/*
 * 解析路由
 * 拦截请求
 * */

namespace depend;


class depend extends view {

    /*
     * 获取url参数，返回route参数
     * index.php?route=home&p=1$limit=20
     * */
    public function get_route($url, $_config, $_default){
        $array = parse_url($url);

        $path = $array['path']; // 访问主路径

        // 拦截关键词“index.php”
        $path_array = explode('.', $path);
        if (isset($path_array[1]) && $path_array[1] == 'php'){
            $this->back_404();
        }

        if (array_key_exists('query', $array)){
            $query = $array['query']; // 访问的参数，即?后面的参数
        }else{ // 没有参数则到默认
            $query = $_config.'='.$_default;
        }

        $query_array = explode('&', $query);

        $new_array = [];
        foreach ($query_array as $value){
            $v = explode('=', $value);
            $new_array[$v[0]] = $v[1];
        }

        if (array_key_exists($_config, $new_array)){
            $route = $new_array[$_config];
            if ($route == 404){
                $this->back_404();
            }else if ($route == ''){
                $this->back_403();
            }
        }else{
            $route = $_default;
        }

        return $route;
    }


}

$dep = new depend();

$url = $_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
$page = $dep->get_route($url, $config['route'], $config['route_default']); // page-name,route-value-name

$_file = 'pages/'.$page.'/'.$page.'.php';
$_file_config = 'pages/'.$page.'/'.$page.'-config.php';

if(!file_exists($_file)){
    echo '模块文件404：缺失'.$page.'.php文件';
    $dep->back_404();
    exit();
}

if(!file_exists($_file_config)){
    echo '模块配置文件404：缺失'.$page.'-config.php文件';
    $dep->back_404();
    exit();
}


