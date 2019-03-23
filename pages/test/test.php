

<!--模块div-->
<div class="test">
    test<br/>
    <br/>
    <a class="a" href="<?=route_string('test_min')?>&p=1">
        test-min路由加密后访问：<?=route_string('test_min')?>&p=b
    </a>
    <br/>
    <?=include VIEW_PATH.'pages/common/foot.php'?>
</div>