<?php

/*
 * 安全校验
 * 1. 可以在此完成登录校验
 * */

namespace common;

use depend\view;

class safeCheck extends view {

    public function login_state(){

        return 0;
    }

}


$check = new safeCheck();
