<?php
/**
 * Cil_Include 初始化文件，其他项目只需引用此文件就可以使用 Cil_Include
 */

/**
 * Cil_Include 根目录，此文件所在目录为项目的根目录，结尾带 DIRECTORY_SEPARATOR
 */
define('CIL_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/**
 * 配置根目录
 */
define('CIL_CONFIGS_DIR', CIL_ROOT . 'cil_configs' . DIRECTORY_SEPARATOR);

/**
 * 函数库根目录
 */
define('CIL_FUNCTIONS_DIR', CIL_ROOT . 'cil_functions' . DIRECTORY_SEPARATOR);

/**
 * 类库根目录
 */
define('CIL_LIBRARIES_DIR', CIL_ROOT . 'cil_libraries' . DIRECTORY_SEPARATOR);

/**
 * 第三方资源类库根目录
 */
define('CIL_THIRDPARTS_DIR', CIL_ROOT . 'cil_thirdparts' . DIRECTORY_SEPARATOR);

/**
 * 导入函数
 */
if (!function_exists('cil_import')) {
    /**
     * 导入函数，支持一次传递多个参数
     * 
     * @param mixed $name Description
     */
    function cil_import() {
        $num_args = func_num_args();
        $func_args = func_get_args();
        if ($num_args == 1) {
            if (is_string($func_args)) {
                $func_args[] = $func_args;
            }
        }
        
        foreach ($func_args as $value) {
            $cil_function_file_php  = CIL_FUNCTIONS_DIR . $value . '.php';
            $cil_function_file_php5 = CIL_FUNCTIONS_DIR . $value . '.php5';
            
            if (file_exists($cil_function_file_php)) {
                require $cil_function_file_php;
            } elseif (file_exists($cil_function_file_php5)) {
                require $cil_function_file_php5;
            } elseif (file_exists($cil_function_file_inc)) {
                require $cil_function_file_inc;
            }
        }
    }
}

/**
 * 类自动加载器
 */
if (!function_exists('cil_autoload'))
{
    /**
     * 类自动加载器
     * 
     * @param string $class_name
     */
    function cil_autoload($class_name = '') {
        $class_file_class_php  = CIL_LIBRARIES_DIR . $class_name . '.class.php';
        $class_file_php        = CIL_LIBRARIES_DIR . $class_name . '.php';
        $class_file_thirdpart_class_php = CIL_THIRDPARTS_DIR . $class_name . DIRECTORY_SEPARATOR . $class_name . '.class.php';
        $class_file_thirdpart_php       = CIL_THIRDPARTS_DIR . $class_name . DIRECTORY_SEPARATOR . $class_name . '.php';
        
        if (file_exists($class_file_class_php)) {
            require $class_file_class_php;
        } elseif (file_exists($class_file_php)) {
            require $class_file_php;
        } elseif (file_exists($class_file_thirdpart_class_php)) {
            require $class_file_thirdpart_class_php;
        } elseif (file_exists($class_file_thirdpart_php)) {
            require $class_file_thirdpart_php;
        }
    }
    
    spl_autoload_register('cil_autoload');
}