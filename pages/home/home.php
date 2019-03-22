<!--模块div-->

<div class="content">

    home
    <br/>
    <a class="a" href="<?=$route_url?><?=route_encode('test')?>">
        test路由加密后访问：<?=route_string('test')?>
    </a>
    <br/>

    <?=include VIEW_PATH.'pages/common/foot.php'?>

</div>


