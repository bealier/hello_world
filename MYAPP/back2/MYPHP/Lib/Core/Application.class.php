<?php
/**
 * Created by PhpStorm.
 * User: xu
 * Date: 2019/8/29
 * Time: 12:36
 */

final class Application{
    public static function run(){
        //初始化框架
        self::_init();
        //设置外部路径
        self::_set_url();
        //自动载入
        spl_autoload_register(array(__CLASS__,'_autoload'));
        //创建demo
        self::_create_demo();
        //实例化控制器
        self::_app_run();
    }

    private static function _set_url(){
        $path = 'http://' .$_SERVER['HTTP_HOST'] .$_SERVER['SCRIPT_NAME'];
        $path = str_replace('\\','/',$path);
        define('__APP__',$path);
        define('__ROOT__',dirname(__APP__));
        define('__TPL__',__ROOT__ . '/'. APP_NAME .'/Tpl');
        define('__PUBLIC__',__TPL__.'/Public');
    }

    private static function _autoload($className){
        include APP_CONTROLLER_PATH .'/' . $className .'.class.php';
    }

    private static function _create_demo(){
        $path =  APP_CONTROLLER_PATH . '/IndexController.class.php';

        $str = <<<str
<?php
    class IndexController extends Controller{
        public function index(){
            echo 'ok';
        }
    }
str;
        is_file($path) || file_put_contents($path,$str);
    }

    private static function _app_run(){
        $c = isset($_GET[C('VAR_CONTROLLER')]) ? $_GET[C('VAR_CONTROLLER')] : 'Index';
        $a = isset($_GET[C('VAR_ACTION')]) ? $_GET[C('VAR_ACTION')] : 'Index';

        $c .= 'Controller';

        $obj = new $c;
        $obj -> $a();
    }

    private static function _init(){
        //加载配置项
        C(include CONFIG_PATH .'/config.php');
        //用户配置项
        $userpath = APP_CONFIG_PATH . '/config.php';
        $userconfig = <<<str
<?php
    return array(
    //配置项 =>配置值
    );
?>
str;
        is_file($userpath) || file_put_contents($userpath,$userconfig);
        //加载用户配置项
        C(include $userpath);
        //设置默认时区
        date_default_timezone_set(C('DEFAULT_TIME_ZONE'));
        //是否开启session
        C('SESSION_AUTO_START') && session_start();
    }
}