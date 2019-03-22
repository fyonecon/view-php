<?php
header("content-type:text/html;charset=utf-8");
$str = "我是加密前的内容"; //加密内容
$key = "key:1111"; //密钥
$cipher = MCRYPT_DES; //密码类型
$modes = MCRYPT_MODE_ECB; //密码模式
$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher,$modes),MCRYPT_RAND);//初始化向量
echo "加密明文：".$str."<p>";
$str_encrypt = mcrypt_encrypt($cipher,$key,$str,$modes,$iv); //加密函数
echo "加密密文：".$str_encrypt." <p>";
echo $str_encrypt=base64_encode($str_encrypt);

//<?php
//header("content-type:text/html;charset=utf-8");
//$key = "key:1111"; //密钥
//$cipher = MCRYPT_DES; //密码类型
//$modes = MCRYPT_MODE_ECB; //密码模式
//$iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher,$modes),MCRYPT_RAND);//初始化向量
//$str_encrypt="trn1duq6vt4i8v66Ea9jo7qZ2X7JWmkf";//这里的值是第2步中的$str_encrypt=base64_encode($str_encrypt);
//$str_encrypt=base64_decode($str_encrypt);
//echo "加密密文：".$str_encrypt." <p>";
//$str_decrypt = mcrypt_decrypt($cipher,$key,$str_encrypt,$modes,$iv); //解密函数
//echo "还原：".$str_decrypt;