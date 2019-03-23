<!--模块div-->
<div class="test-min">
    test-min
    <a class="a" href="<?=route_string('home')?>">
        home路由加密后访问：<?=route_string('home')?>
    </a>

    <?=include VIEW_PATH.'pages/common/foot.php'?>
</div>

<style>

    .test-min{
        color: lightskyblue;
    }

</style>

<script>
    
    (function () {
        console.log("test-min");

    })();
    
</script>