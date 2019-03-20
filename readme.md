## view-php：view框架的php写法

### 使用与配置
#### 1. 目录介绍：
- ---config  // 自定义配置文件夹
- ------config.php // 公用文件配置
- ------safe_check.php // 页面安全检测
- ---depend  // 框架解析，解析路由，拦截非法请求，一般不需要修改
- ------depend.php // 解析路由，拦截非法请求
- ------html,php // html标签主模板，不需要修改
- ------view,php // 框架依赖的一些公共函数
- ---pages  // 模块页面文件夹 
- ------common // 公用模块文件夹 
- ------test  // 测试或者叫范例模块
- ------test-min
- ------index.html
- ---static  // 静态公用js、css文件夹
- ------css
- ------js
- ------index.html
- ---index.php  // 入库文件

#### 2. 配置
- 配置分为公用文件配置和模块文件配置
- 模块文件配置又分为模块公用部分和模块单独部分
- config/文件夹配置公用文件
- pages/文件夹配置模块文件，模块在此注册
- 配置只需配置config/和pages/文件夹
- static/文件夹放置静态文件，比如js、css、img等
- depend/文件夹一般不需要修改

#### 3. 框架解析生命周期
index.php入口（但不必显示入口文件名）——解析url参数——路由参数验证，拦截非法请求——载入html.php主模板——页面安全校验（可以放比如登录等内容）——载入公用js、css——载入页面模块——载入模块js、css——完成

#### 4. 静态文件缓存
公用js、css默认缓存1000s，模块js、css默认缓存100s

## view框架的js写法 请前往https://github.com/fyonecon/view 。类似的配置，类似解析，类似的构造