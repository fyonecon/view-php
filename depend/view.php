<?php
/*
 * PHP公共函数
 * */

namespace depend;

class view {

    protected $s_key;
    public function __construct(){
        // parent::__construct();
        $this->s_key = md5($this->server_ip()); // 解密密钥

    }

    /*
     * php正则出url所有参数
     * 支持 ?、$、#
     * */
    public function getUrlKeyValue($url){
        $result = array();
        $mr     = preg_match_all('/(\?|&|#)(.+?)=([^&?#]*)/i', $url, $matchs);
        if ($mr !== false) {
            for ($i = 0; $i < $mr; $i++) {
                $result[$matchs[2][$i]] = $matchs[3][$i];
            }
        }
        return $result;
    }

    /*
     * 获取url键的参数
     * */
    public function getThisUrlValue($url, $key){
        $array = $this->getUrlKeyValue($url);

        if ($array){
            if(isset($array[$key])){
                $value = $array[$key];
            }else{ // 无匹配键
                $value = 'not-that-key';
            }
        }else{ // 有匹配键但是无参数
            $value = null;
        }

        return $value;
    }

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
    public function back_404($txt = '页面未发现，可能是输入的网址有问题。'){
        $this->httpStatus(404);
        echo $this->div_notice('404', $txt);
        exit;
    }

    /*
     * 返回403状态
     * */
    public function back_403($txt = '网址参数不完整，路由错误，拒绝继续访问'){
        $this->httpStatus(403);
        echo '<div style="font-size: 18px;padding: 5px 10px;"><span style="color: red;" id="back-div">5</span><span>  秒后自动返回上一级</span>
            <script>
                var num = 5;
                var si = 0;
                si = setInterval(function() {
                    document.getElementById("back-div").innerHTML= num;
                    if (num===0){
                        history.go(-1);
                    } 
                    if (num === -1){
                         clearInterval(si);
                         window.location.replace("./?");
                    } 
                    num--;
                }, 1000);
            </script></div>';
        echo $this->div_notice('403', $txt);
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

    public function div_notice($code, $txt){

        $div = '<meta name="viewport" content="width=device-width, initial-scale=1.0"><title>访问出现问题</title><div style="position:fixed; width: 100%; height: 100%;background: rgba(0,0,0,0.5); top: 0; left: 0;z-index: 300; color: white;font-size: 15px; letter-spacing: 2px;"><div style="padding: 30px 20px;"><div style="padding-top: 10px;">访问状态：'.$code.'</div><div style="padding-top: 10px;">问题描述：'.$txt.'</div></div></div>';

        exit($div);
    }

    // 加密
    public function encode($string = '', $skey = 'dog2019') {
        $strArr = str_split(base64_encode($string));
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value){
            $key < $strCount && $strArr[$key].=$value;
        }

        return str_replace(array('=', '+', '/', '4'), array('I', 'I', 'I', 'I'), join('', $strArr));
    }

    // 解密
    public function decode($string = '', $skey = 'dog2019') {
        $strArr = str_split(str_replace(array('I', 'I', 'I', 'I'), array('=', '+', '/', '4'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value){
            $key <= $strCount && @$strArr[$key][1] === $value && @$strArr[$key] = @$strArr[$key][0];
        }

        return base64_decode(join('', $strArr));
    }

    public function string_encode($encode_string){
        // 密钥加密密钥取决于服务器IP的md5
        return $this->encode($encode_string, $this->s_key);
    }

    public function string_decode($decode_string){
        // 密钥加密密钥取决于服务器IP的md5
        return $this->decode($decode_string, $this->s_key);
    }

}




