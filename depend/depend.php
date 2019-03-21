<?php
/*
 * 解析路由
 * 拦截请求
 * */
namespace depend;

class depend extends view {

    /*
     * 获取url参数，返回route参数
     * 使用正则所匹配的范围更广，而且比$_GET安全
     * xx/?route=home&p=1$limit=20
     * */
    public function get_route($url, $route_key, $default_route_value){

        // 屏蔽index.php访问
        $array = parse_url($url);
        $path = $array['path'];
        if (strpos($path,'index.php') !== false || strpos($path,'index') !== false){
            $this->back_404();
            exit();
        }

        // 计算路由
        $route_value = $this->getThisUrlValue($url, $route_key);
        if ($route_value == null){
            $route_value = $this->string_encode($default_route_value);
        }else if ($route_value == 'not-that-key'){
            $this->back_403();
        }

        return $this->string_decode($route_value);
    }

}
$depend = new depend();

$url = $_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
$page = $depend->get_route($url, isset($route)?$route:'', isset($route_default)?$route_default:''); // page-name,route-value-name

$_file = 'pages/'.$page.'/'.$page.'.php';
$_file_config = 'pages/'.$page.'/'.$page.'-config.php';

if(!file_exists($_file)){
    echo '模块文件404：缺失模块'.$page.'文件';
    $depend->back_404();
    exit();
}

if(!file_exists($_file_config)){
    echo '模块配置文件404：缺失模块'.$page.'-config文件';
    $depend->back_404();
    exit();
}


