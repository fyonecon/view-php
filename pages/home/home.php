<!--模块div-->

<div class="content">

    home
    <br/>
    <a class="a" href="<?=$route_url?><?=route_encode('test')?>">test</a><br/>

    <?=route_string('test')?>

    <?=include VIEW_PATH.'pages/common/foot.php'?>

</div>


