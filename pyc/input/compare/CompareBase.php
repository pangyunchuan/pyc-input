<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 09:32
 */

namespace pyc\input\compare;

/**
 * 比较数据
 * Class CompareBase
 * @package pyc\input\compare
 */
abstract class CompareBase
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
     * 比较方法,后代实现
     * @param $v1
     * @param $v2
     * @return
     */
    abstract public function compare($v1, $v2);

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