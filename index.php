<?php

/*
 * 应用入口文件
 * 1. 框架解析对SEO友好
 * 2. 模块化应用，业务逻辑清晰
 * 3. url访问隐藏实际文件
 * */

require_once 'config/config.php';   // 参数配置
require_once 'depend/view.php';     // 公共函数
require_once 'depend/depend.php';   // 计算路由，拦截请求

require_once 'depend/html.php';     // 根据路由渲染页面

// 访问路由固定写法/?route=xxx&test=xx





