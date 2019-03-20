<?php
/*
 * 安全校验
 * 1. 可以在此完成登录校验
 * */

use depend\view;

class safeCheck extends view {

    public function ip_check(){

        $ip = $this->user_ip();

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

echo $check->login_state();