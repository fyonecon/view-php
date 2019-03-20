<?php

/*
 * html主体文件
 * 整个文件不需要更改
 * */
require_once 'config/safe_check.php';
include $_file_config;

?>


<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=isset($title)?$title:'view-php';?></title>
    <link rel="icon" href="static/favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content="web前端框架view的php重写"/>
    <?php
    // 以下不需要修改

    $css = $page_file['head_css'];
    $js = $page_file['head_js'];

    for ($c=0; $c<count($css); $c++){
        echo '<link class="h-css h-css-'.$c.'" rel="stylesheet" href="'.$file_url.'static/'.$css[$c].'?'.$file_time.'" />';
    }

    for ($j=0; $j<count($js); $j++){
        echo '<script class="h-js h-js-'.$j.'" src="'.$file_url.'static/'.$js[$j].'?'.$file_time.'"></script>';
    }

    ?>
    <script>

        // ES6写法
        const api_url = "<?=$config['file_url']?>";
        const route_url = "<?=$route_url?>";
        const file_url = "<?=$file_url;?>";

    </script>
</head>
<body class="body" time="<?=$config['page_time'];?>">

<!--注射-->
<div class="view-div">

<?php
// 以下不需要修改

include $_file;

?>

</div>

<?php
// 以下不需要修改

$js = $page_file['foot_js'];
for ($f=0; $f<count($js); $f++){
    echo '<script class="f-js f-js-'.$f.'" src="'.$file_url.'static/'.$js[$f].'?'.$file_time.'"></script>';
}

if(isset($route_file)){
    $r_js = $route_file['js'];
    $r_css = $route_file['css'];
    $js_string = '';
    $css_string = '';
    for ($r_c=0; $r_c<count($r_css); $r_c++){
        $css_string .= '<link class="r-css r-css-'.$r_c.'" rel="stylesheet" href="'.$file_url.'pages/'.$page.'/'.$r_css[$r_c].'?'.$time_config.'" />';
    }
    for ($r_j=0; $r_j<count($r_js); $r_j++){
        $js_string .= '<script class="r-js r-js-'.$r_j.'" src="'.$file_url.'pages/'.$page.'/'.$r_js[$r_j].'?'.$time_config.'"></script>';
    }
    echo $css_string;
    echo $js_string;
}else{
    exit('模块文件的配置参数不完整：'.$page.'-config.php缺少route_file参数');
}

?>

</body>
</html>
