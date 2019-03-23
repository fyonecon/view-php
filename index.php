<?php
/*
 * 应用入口文件
 * 1. 框架解析对SEO友好
 * 2. 模块化应用，业务逻辑清晰
 * 3. url访问隐藏实际文件
 * */

// 访问路由固定写法xx/?route=xxx&test=aaa，注意url访问已经屏蔽了index.php?

define('VIEW_PATH', dirname(__FILE__).'/', false); // 项目的绝对路径，对大小写敏感

require_once VIEW_PATH.'config/config.php';   // 参数配置
require_once VIEW_PATH.'depend/view.php';     // 框架依赖的公共函数
require_once VIEW_PATH.'depend/depend.php';   // 计算路由，拦截请求
require_once VIEW_PATH.'depend/html.php';     // 根据路由渲染页面



