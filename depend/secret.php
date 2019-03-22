<?php

namespace depend;

class secret {

    private $secret_key = 'view2019'; // 密钥：字母、数字、中文等任意内容
    private $salt = 19; // 容错度：数字范围[0, 63]

    public function __construct(){
        $this->secret_key = ip2long($_SERVER['SERVER_ADDR']);
        $this->secret_key = md5($this->secret_key).sha1($this->secret_key).md5($this->salt).sha1($this->salt); // len 144

    }

    public function en_mix($str){
        $key_str = $this->secret_key;
        $len1 = strlen($key_str);
        $len2 = strlen($str);

        $new_array = [];
        if ($len1<=$len2){
            for ($i=0; $i<$len1; $i++){
                $new_array[] = $key_str[$i];
                $new_array[] = $str[$i];
            }
        }else{
            for ($i=0; $i<$len2; $i++){
                $new_array[] = $key_str[$i];
                $new_array[] = $str[$i];
            }
        }

        $string = implode('', $new_array);
        return $string;
    }

    public function de_mix($str){
        $new_array = [];
        for ($i=0; $i<strlen($str); $i++){
            if ($i%2 != 0){
                $new_array[] = $str[$i];
            }
        }

        $string = implode('', $new_array);
        return $string;
    }

    public function to_string($data){ // 字符串变“数字 和 字母”字符串
        $new = base64_encode($data);
        $string = '';

        $replace = [ // 建议使用不一样的[0]对应[1]，密钥对照表
            ['=', 'ao1c'], // 必须
            ['/', 'gen1'], // 必须
            ['+', 'hba1'], // 必须
            ['3', 'gen2'],
            ['7', '6lon'],
            ['8', 'o6oi'],
            ['9', 'huw4'],
            ['L', 'aiih'],
            ['M', 'lmvk'],
            ['W', 'l0ig'],
            ['z', 'a2lj'],
            ['y', 'a4bs'],
            ['d', 'e1fg'],
        ];

        for ($i=0; $i<count($replace); $i++){
            $string = str_replace(@$replace[$i][0], @$replace[$i][1], $new);
            $new = $string;
        }

        return $this->en_mix($string);
    }

    public function to_data($string){ // 数字 和 字母”字符串变“字符串
        //$old_string = $string;
        $old_string = $this->de_mix($string);
        $data = '';

        $replace = [ // 建议使用不一样的[0]对应[1]
            ['=', 'ao1c'], // 必须
            ['/', 'gen1'], // 必须
            ['+', 'hba1'], // 必须
            ['5', 'hao2'],
            ['3', 'gen2'],
            ['7', '6lon'],
            ['8', 'o6oi'],
            ['9', 'huw4'],
            ['L', 'aiih'],
            ['M', 'lmvk'],
            ['W', 'l0ig'],
            ['z', 'a2lj'],
            ['y', 'a4bs'],
            ['d', 'e1fg'],
        ];

        for ($i=0; $i<count($replace); $i++){
            $data = str_replace(@$replace[$i][1], @$replace[$i][0], $old_string);
            $old_string = $data;
        }

        return  base64_decode($data);
    }

    public function make_key_value(){ // 生成一位加密对照表
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; // 不需要修改内容，但是可以修改字符数字的顺序
        $new_string = $string.$string;
        $salt = $this->salt;

        if ($salt < 0 || $salt > strlen($string)){
            $salt = ceil(strlen($string)/3);
        }

        $array1 = [];
        $array2 = [];
        for ($m=0; $m<strlen($string); $m++){
            $array1[$string[$m]] = $new_string[$m+$salt];
            $array2[$new_string[$m+$salt]] = $string[$m];
        }

        return [$array1, $array2];
    }

    public function encode($data) {
        $new_data = $this->to_string($data);
        $replace = $this->make_key_value()[0];

        $new_data_array = [];
        for ($n=0; $n<strlen($new_data); $n++){
            $new_data_array[] = $new_data[$n];
        }

        $array = [];
        for ($i=0; $i<count($new_data_array); $i++){
            $key = $new_data_array[$i];
            $value = $replace[$key];
            $array[] = $value;
        }

        $string = implode('', $array);
        return trim($string);
    }

    public function decode($data) {
        $new_data = $data;
        $replace = $this->make_key_value()[1];

        $new_data_array = [];
        for ($n=0; $n<strlen($new_data); $n++){
            $new_data_array[] = $new_data[$n];
        }

        $array = [];
        for ($i=0; $i<count($new_data_array); $i++){
            $key = $new_data_array[$i];
            $value = $replace[$key];

            $array[] = $value;
        }

        $string = implode('', $array);
        $data = $this->to_data($string);
        return trim($data);
    }
}

