<?php
class test {

    private $secret_key = 'abc3333';

    public function __construct(){
        $this->secret_key = $this->to_string($this->secret_key);

    }

    public function to_string($data){ // 字符串变“数字 和 字母”字符串
        $new = base64_encode($data);
        print_r($new);
        echo '<br/>';
        $string = '';

        $replace = [ // 建议使用不一样的[0]对应[1]
            ['=', 'hao123'],
            ['/', 'gen123'],
            ['+', 'hua123'],
        ];

        for ($i=0; $i<count($replace); $i++){
            $string = str_replace(@$replace[$i][0], @$replace[$i][1], $new);
        }

        return $string;
    }

    public function to_data($string){ // 数字 和 字母”字符串变“字符串
        $old_string = $string;
        $data = '';

        $replace = [ // 建议使用不一样的[0]对应[1]
            ['=', 'hao123'],
            ['/', 'gen123'],
            ['+', 'hua123'],
        ];

        for ($i=0; $i<count($replace); $i++){
            $data = str_replace(@$replace[$i][1], @$replace[$i][0], $old_string);
        }

        return  base64_decode($data);
    }

    public function encode($data) {


        return trim($data);
    }

    public function decode($data) {


        return trim($data);
    }
}


$test = new test();
$res = $test->to_string('abc3333');
$old = $test->to_data($res);

echo $res.'<br/>'.$old;
