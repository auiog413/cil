<?php
// 目录分隔符
define('D_S', DIRECTORY_SEPARATOR);
// src 目录绝对路径
define('SRC_DIR', dirname(dirname(__FILE__)) . D_S . 'src' . D_S);
// 载入初始化文件
require SRC_DIR . 'cil_init.php';

echo CIL_ROOT . '<br />';
echo CIL_CONFIGS_DIR . '<br />';
echo CIL_FUNCTIONS_DIR . '<br />';
echo CIL_LIBRARIES_DIR . '<br />';
?>
