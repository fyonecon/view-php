<?php
/*
 * 解析路由
 * 拦截请求
 * */
namespace depend;

$website = $_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; // 页面网址

define('VIEW_VERSION', '1.0', false);                   // view依赖的版本
define('VIEW_GIT', 'github.com/fyonecon/view-php');     // 项目开源地址
define('WEBSITE', $website, false);                     // 页面网址
define('ROUTE_URL', $route_url, false);                 // 路由主地址
define('SPIDER', $robot_spider, false);
define('OLD_PHP', $old_php, false);
define('ROUTE_ENCODE', $route_encode, false);

final class depend extends view {

    /*
     * 获取url参数，返回route参数
     * 使用正则所匹配的范围更广，而且比$_GET安全
     * xx/?route=home&p=1$limit=20
     * */
    public function get_route($url, $route_key, $default_route_value){

        // 屏蔽index.php访问
        $array = parse_url($url);
        $path = $array['path'];
        if (strpos($path,'index.php') !== false){
            $txt = '已经屏蔽了 index.php 访问路由。';
            $this->write_log($txt, __LINE__);
            $this->back_404();
        }

        // 判断日志文件夹的文件是否可写
        $file_chmod = VIEW_PATH.'log/index.html';
        if (!file_exists($file_chmod)){
            if (!is_writable($file_chmod)){
                $txt = VIEW_PATH.'log/ 文件夹权限可能不是777，view已经停止运行。';
                $this->back_404($txt);
            }
        }

        // 计算路由
        $route_value = $this->getThisUrlValue($url, $route_key);
        if ($route_value == null){
            if (ROUTE_ENCODE == true){
                $route_value = $this->string_encode($default_route_value);
            }else{
                $route_value = $default_route_value;
            }
        }else if ($route_value == 'not-that-key'){
            $this->back_403();
        }

        // 屏蔽所有搜索引擎爬虫
        if (SPIDER == true){
            $robot = $this->is_robot();
            if ($robot[0] == 1){
                $txt = '系统开启了拒绝Spider访问。';
                $this->write_log($txt, __LINE__);
                return $this->back_403($txt);
            }
        }

        // 屏蔽低版本PHP
        if (OLD_PHP == true){
            $version_array = explode('.',  phpversion());
            $version_string = $version_array[0]*10+$version_array[1];
            if ($version_string < 71){
                $txt = '系统要求PHP最低版本为7.1.x。';
                $this->write_log($txt, __LINE__);
                return $this->back_403($txt);
            }
        }

        // 是否对路由加密解密
        if (ROUTE_ENCODE == true){
            return $this->string_decode($route_value); // 路由解密。模块访问路由是先加密的，否则会出现访问404。
        }else{
            return $route_value;
        }


    }

}
$depend = new depend();

// 解析路由
$page = $depend->get_route($website, isset($route)?$route:'', isset($route_default)?$route_default:''); // page-name,route-value-name

$_file = VIEW_PATH.'pages/'.$page.'/'.$page.'.php'; // 模块div文件
$_file_config = VIEW_PATH.'pages/'.$page.'/'.$page.'-config.php'; // 模块配置文件

if(!file_exists($_file)){
    $txt = '模块文件404：缺失模块'.$page.'文件';
    echo $txt;
    $depend->write_log($txt, __LINE__);
    $depend->back_404();
    exit();
}

if(!file_exists($_file_config)){
    $txt = '模块配置文件404：缺失模块配置'.$page.'-config文件';
    echo $txt;
    $depend->write_log($txt, __LINE__);
    $depend->back_404();
    exit();
}

