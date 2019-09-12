<?php
/**
 * Created by PhpStorm.
 * User: xu
 * Date: 2019/8/28
 * Time: 17:26
 */

final class MYPHP
{
    static function run()
    {
        self::_set_const();
        self::_create_dir();
        self::_import_file();
        Application::run();
    }


    private static function _set_const()
    {
        $path = str_replace('\\','/',__FILE__);
        define('MYPHP_PATH',dirname($path));
        define('CONFIG_PATH',MYPHP_PATH . '/Config');
        define('DATA_PATH',MYPHP_PATH.'/Data');
        define('LIB_PATH',MYPHP_PATH.'/Lib');
        define('TPL_PATH',DATA_PATH.'/Tpl');
        define('CORE_PATH',LIB_PATH.'/Core');
        define('FUNCTION_PATH',LIB_PATH.'/Function');
        define('ROOT_PATH',dirname(MYPHP_PATH));
        //应用目录
        define('APP_PATH',ROOT_PATH.'/'.APP_NAME);
        define('APP_CONFIG_PATH',APP_PATH.'/Config');
        define('APP_TPL_PATH',APP_PATH . '/Tpl');
        define('APP_CONTROLLER_PATH',APP_PATH .'/Controller');
        define('APP_PUBLIC_PATH',APP_NAME. '/Public');

    }

    private static function _create_dir(){
        $arr = array(
            APP_PATH,
            APP_CONTROLLER_PATH,
            APP_TPL_PATH,
            APP_PUBLIC_PATH,
            APP_CONFIG_PATH
        );
        foreach ($arr as $v){
            is_dir($v) || mkdir($v,0777,true);
        }
    }


    private static function _import_file(){
        $list = array(
          FUNCTION_PATH .'/Function.php',
          CORE_PATH .'/Controller.class.php',
          CORE_PATH .'/Application.class.php'
        );
        foreach ($list as $v){
            require_once $v;
        }
    }
}

myPHP::run();