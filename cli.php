<?php
// cli应用入口文件

// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) die('require PHP > 5.3.0 !');
if (PHP_SAPI != "cli") die('need cli run');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
//define('APP_DEBUG', True);

// 定义应用目录
define('APP_PATH', __DIR__ . '/Application/');
define('BUILD_DIR_SECURE', false);
define('BIND_MODULE','Console');
define('APP_MODE', 'cli');

// 引入ThinkPHP入口文件
require __DIR__ . '/ThinkPHP/ThinkPHP.php';
