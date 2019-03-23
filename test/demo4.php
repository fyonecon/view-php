<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/3/23
 * Time: 17:21
 */

function group_arrays($info, $key1, $key2){ // 两个键值相等时的去重

    $have = [];
    $array = [];
    $index = [];

    for($m=0; $m<count($info); $m++){
        $has1 = $info[$m][$key1];
        $has2 = $info[$m][$key2];

        if (in_array([$has1=>$has2], $array)){
            // 存在则跳过
        }else{
            $array[] = [$has1=>$has2];
            $index[] = $m;
        }
    }

    foreach ($index as $value){
        $have[] = $info[$value];
    }

    return $have;
}


$array = [
    ['a_id'=>11, 'b_id'=>12, 'txt'=>'=1='],
    ['a_id'=>11, 'b_id'=>12, 'txt'=>'=2='],
    ['a_id'=>13, 'b_id'=>23, 'txt'=>'=3='],
    ['a_id'=>14, 'b_id'=>14, 'txt'=>'=4='],
    ['a_id'=>13, 'b_id'=>23, 'txt'=>'=5='],
];

var_dump(group_arrays($array, 'a_id', 'b_id'));