<?php
/*
 * 安全校验
 * 1. 可以在此完成登录校验
 * */
namespace config;
use depend\view;

// 自定义的公共函数，此公共函数推荐在模块安全检测及模块中使用
// 而框架依赖的公共函数可以在任意地方使用
require_once 'common.php';

class safeCheck extends view {

    public function ip_check(){

        $ip = user_ip();

        $black_ip = [
            //'::1', // localhost
            //'127.0.0.1',
        ];

        if(in_array($ip, $black_ip)){
            return $this->back_404();
        }else{
            return $ip;
        }

    }

    public function login_state(){

        $ip = $this->ip_check();
        return $ip;
    }

}

$check = new safeCheck();
