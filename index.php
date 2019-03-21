<?php

/*
 * 应用入口文件
 * 1. 框架解析对SEO友好
 * 2. 模块化应用，业务逻辑清晰
 * 3. url访问隐藏实际文件
 * */
require_once 'config/config.php';   // 参数配置
require_once 'depend/view.php';
require_once 'depend/depend.php';   // 计算路由，拦截请求
require_once 'depend/html.php';     // 根据路由渲染页面

// 访问路由固定写法xx/?route=xxx&test=aaa，注意url访问已经屏蔽了index.php?





