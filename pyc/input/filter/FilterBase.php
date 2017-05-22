<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 14:31
 */

namespace pyc\input\filter;

/**
 * 过滤数据
 * Class FilterBase
 * @package pyc\input\filter
 */
abstract class FilterBase
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
     * 过滤方法,后代实现
     * @param $val
     * @return
     */
    abstract public function filter($val);

    /**
     * 调用不存在的都返回 null
     * @param $name
     * @param $arguments
     * @return bool
     */
    final public function __call($name, $arguments)
    {
        return null;
    }

}