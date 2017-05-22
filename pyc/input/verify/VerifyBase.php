<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17 0017
 * Time: 10:29
 */

namespace pyc\input\verify;

/**
 * 验证数据
 * Class VerifyBase
 * @package pyc\input\verify
 */
abstract class VerifyBase
{
    private function __construct(){}
    private static $_obj = array();
    /**
     * @return $this
     */
    final public static function obj(){
        $class = get_called_class();
        if(!isset(self::$_obj[$class]) || !is_object(self::$_obj[$class])){
            self::$_obj[$class] = new $class;
        }
        return self::$_obj[$class];
    }

    /**
     * 验证方法,后代实现
     * @param $val
     * @return
     */
    abstract public function verify($val);

    /**
     * 调用不存在的都返回 false
     * @param $name
     * @param $arguments
     * @return bool
     */
    final public function __call($name, $arguments)
    {
        return false;
    }
}