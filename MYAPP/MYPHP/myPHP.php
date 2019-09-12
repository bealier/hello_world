<?php
/**
 * Created by PhpStorm.
 * User: xu
 * Date: 2019/8/30
 * Time: 15:19
 */

final class MYPHP
{
    static function run(){
        self::_set_const();
        self::_create_dir();
        self::_import_file();
        Application::run();
    }

    static function _set_const(){

    }
    static function _create_dir(){

    }
    static function _import_file(){

    }

}

myPHP::run();