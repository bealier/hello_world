<?php
/**
 * Created by PhpStorm.
 * User: xu
 * Date: 2019/8/13
 * Time: 17:50
 */


final class MYPHP{
    public static function run(){
        //第一步设置常量
        self::_set_const();
        //第二步创建文件夹
        self::_create_dir();
        //第三步载入必要文件
        self::_import_file();
        //执行应用类
        Application::run();
    }

    private static function _set_const(){
//        "D:\www\myApp\myPHP\myPHP.php"
//        var_dump(__FILE__);
        $path = str_replace('\\','/',__FILE__);
        define('MYPHP_PATH',dirname($path));
        define('CONFIG_PATH',MYPHP_PATH . '/Config');
        define('DATA_PATH',MYPHP_PATH.'/Data');
        define('TPL_PATH',DATA_PATH.'/Tpl');
        define('LIB_PATH',MYPHP_PATH.'/Lib');
        define('CORE_PATH',LIB_PATH.'/Core');
        define('FUNCTION_PATH',LIB_PATH.'/Function');
        define('ROOT_PATH',dirname(MYPHP_PATH));
        //应用目录
        define('APP_PATH',ROOT_PATH.'/'.APP_NAME);
        define('APP_CONFIG_PATH',APP_PATH. '/Config');
        define('APP_CONTROLLER_PATH',APP_PATH . '/Controller');
        define('APP_PUBLIC_PATH',APP_PATH.'/Public');
        define('APP_TPL_PATH',APP_PATH.'/Tpl');

    }

    private static function _create_dir(){
        $arr = array(
            APP_PATH,
            APP_CONFIG_PATH,
            APP_CONTROLLER_PATH,
            APP_PUBLIC_PATH,
            APP_TPL_PATH
        );
        foreach ( $arr as $v){
            is_dir($v) || mkdir ($v,0777,true);
        }
    }

    private static function _import_file(){
        $fileArr = array(
            FUNCTION_PATH.'/Function.php',
            CORE_PATH.'/Controller.class.php',
            CORE_PATH.'/Application.class.php',
        );
        foreach ($fileArr as $v){
            require_once $v;
        }
    }
}

MYPHP::run();


?>