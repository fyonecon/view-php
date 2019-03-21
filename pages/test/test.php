

<!--模块div-->
<div class="test">
    test<br/>
    注意，a标签访问需要加秘密route的值，比如=route_encode('test')<br/>
    <a class="a" href="<?=$route_url?><?=route_encode('home')?>">home</a><br/>
    <?=include 'pages/common/foot.php'?>
</div>