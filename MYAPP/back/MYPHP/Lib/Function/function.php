<?php
/**
 * Created by PhpStorm.
 * User: xu
 * Date: 2019/8/13
 * Time: 22:24
 */

    function p($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }

    //1.加载配置项
    //2.C($sysConfig) C($userConfig)
    //C('CODE_LEN')
    //3.临时动态变量配置项
    //C('CODE_LEN',28)
    //4.C();
    function C($var = NULL , $value = NULL){
        static $config = array();
        if (is_array($var)){
            $config = array_merge($config,array_change_key_case($var,CASE_UPPER));
            return;
        }

        if(is_string($var)){
            $var = strtoupper($var);
            //两个参数传参
            if(!is_null($value)){
                $config[$var] = $value;
                return ;
            }
            return isset($config[$var]) ? $config[$var] : NULL;

        }
        if(is_null($var) && is_null($value)){
            return $config;
        }

    }

?>

