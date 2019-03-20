<?php
/*
 * PHP公共函数
 * */

namespace depend;

class view {

    public function httpStatus($num){//网页返回码
        static $http = array (
            100 => "HTTP/1.1 100 Continue",
            101 => "HTTP/1.1 101 Switching Protocols",
            200 => "HTTP/1.1 200 OK",
            201 => "HTTP/1.1 201 Created",
            202 => "HTTP/1.1 202 Accepted",
            203 => "HTTP/1.1 203 Non-Authoritative Information",
            204 => "HTTP/1.1 204 No Content",
            205 => "HTTP/1.1 205 Reset Content",
            206 => "HTTP/1.1 206 Partial Content",
            300 => "HTTP/1.1 300 Multiple Choices",
            301 => "HTTP/1.1 301 Moved Permanently",
            302 => "HTTP/1.1 302 Found",
            303 => "HTTP/1.1 303 See Other",
            304 => "HTTP/1.1 304 Not Modified",
            305 => "HTTP/1.1 305 Use Proxy",
            307 => "HTTP/1.1 307 Temporary Redirect",
            400 => "HTTP/1.1 400 Bad Request",
            401 => "HTTP/1.1 401 Unauthorized",
            402 => "HTTP/1.1 402 Payment Required",
            403 => "HTTP/1.1 403 Forbidden",
            404 => "HTTP/1.1 404 Not Found",
            405 => "HTTP/1.1 405 Method Not Allowed",
            406 => "HTTP/1.1 406 Not Acceptable",
            407 => "HTTP/1.1 407 Proxy Authentication Required",
            408 => "HTTP/1.1 408 Request Time-out",
            409 => "HTTP/1.1 409 Conflict",
            410 => "HTTP/1.1 410 Gone",
            411 => "HTTP/1.1 411 Length Required",
            412 => "HTTP/1.1 412 Precondition Failed",
            413 => "HTTP/1.1 413 Request Entity Too Large",
            414 => "HTTP/1.1 414 Request-URI Too Large",
            415 => "HTTP/1.1 415 Unsupported Media Type",
            416 => "HTTP/1.1 416 Requested range not satisfiable",
            417 => "HTTP/1.1 417 Expectation Failed",
            500 => "HTTP/1.1 500 Internal Server Error",
            501 => "HTTP/1.1 501 Not Implemented",
            502 => "HTTP/1.1 502 Bad Gateway",
            503 => "HTTP/1.1 503 Service Unavailable",
            504 => "HTTP/1.1 504 Gateway Time-out"
        );
        header($http[$num]);
    }

    /*
     * 返回404状态
     * */
    public function back_404(){
        $this->httpStatus(404);
        echo '404-页面未发现';
        exit;
    }

    /*
     * 返回403状态
     * */
    public function back_403(){
        $this->httpStatus(403);
        echo '403-路由错误，拒绝访问';
        exit;
    }

    /*
     * GET请求
     * */
    public function php_get($api_url){
        if (!$api_url){
            return null;
        }
        // GET
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);     // 最多等待时间
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $tmpInfo = curl_exec($curl); // 返回
        //关闭URL请求
        curl_close($curl);
        return $tmpInfo;
    }

    /*
     * POST请求
     * $data格式["name" => "", "pwd" => ""];
     * */
    public function php_post($api_url, $data_array){
        if (!$api_url || gettype($data_array) != 'array') {
            return null;
        }
        // POST
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url);             // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);     // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1);            // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_array);   // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);        // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0);          // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            return 'php_post_error='.curl_error($curl);//捕抓异常
        }
        curl_close($curl);
        return $tmpInfo;
    }

    /*
     * 获取服务器IP
     * */
    public function server_ip(){
        return $_SERVER['SERVER_ADDR'];
    }

    /*
     * 获取客户端IP
     * */
    public function user_ip(){
        return $_SERVER['REMOTE_ADDR'];
    }

    /*
     * 返回当前毫秒时间戳
     * */
    public function now_timestamp() {
        list($ms, $sec) = explode(' ', microtime());
        $time = (float)sprintf('%.0f', (floatval($ms) + floatval($sec)) * 1000);
        return $time;
    }



}




