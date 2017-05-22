<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/16 0016
 * Time: 15:39
 */

namespace pyc\input\input;


use pyc\input\compare\CompareBase;
use pyc\input\filter\FilterBase;
use pyc\input\verify\VerifyBase;

final class Input
{
    private function __construct(){}
    private static $_obj = array();
    protected static $data = array();//数据池(todo 不是单例后用静态)
    protected static $error = array();//错误信息
    protected $sorce = array();//数据源,,$_request,$_get,$_post,,任意数组,,cookie,session也行
    protected $opList = array();//要操作的字段列表,验证或过滤

    //todo data 内部参数验证,,未实现
//    protected $is_inner = false;//内部参数,,数据池的 深层

    /**
     * @return $this
     */
    final public static function obj(){
        $class = get_called_class();
        if(!isset(self::$_obj[$class]) || !is_object(self::$_obj[$class])) self::$_obj[$class] = new $class;
        return self::$_obj[$class];
    }

    /**
     * 设置数据源,post,get,request,或自定义的数组
     * @param null $sorce
     * @return $this
     */
    public function sorce($sorce = null){
        if(is_null($sorce)){
            $sorce = $_REQUEST; //默认request
        }elseif (is_array($sorce)){

        }else{
            $sorce = array();
        }
        $this->sorce = $sorce;
        return $this;
    }

    /**
     * 单个字段
     * @param $field
     * @param $default
     * @return $this
     */
    public function recive($field, $default = null){
        //已经取值的参数,跳过
        if( isset(self::$data[$field])) return $this;
        self::$data[$field] = isset($this->sorce[$field]) ? $this->sorce[$field] : $default;//没有传递,用默认值
        return $this;
    }


    /**
     * 多个字段
     * @param array $array 格式  [ [$field,$default(可选)],........ ]
     * @return $this
     */
    public function reciveMore(array $array = array()){
        foreach ($array as $param) call_user_func_array(array($this, 'recive'),$param);
        return $this;
    }

    /**
     * 设置之后验证或过滤的值
     * @param string|null $field  null全部,string,多个用逗号隔开
     * @return $this
     */
    public function setOpField($field = null){
        $verifyField = array();
        if(is_null($field)){
            $verifyField = array_keys(self::$data);
        }elseif(is_string($field)){
            $verifyField =  explode(',',$field);
        }

        $this->opList = $verifyField;
        return $this;
    }

    /**
     * 过滤,
     * @param FilterBase $filter
     * @return $this
     */
    public function filter(FilterBase $filter){
        foreach ($this->opList as $field) {
            self::$data[$field] = $filter->filter(self::$data[$field]);
        }
        return $this;
    }

    /**
     * 函数过滤
     * @param $fun  过滤函数名 val作为第一个参数
     * @param array $param 其他可选参数
     * @return $this
     */
    public function filterCall($fun,$param = array()){
        foreach ($this->opList as $field) {
            $val = self::$data[$field];
            $tempParam = $param;
            array_unshift($tempParam,$val);
            $val = call_user_func_array($fun,$tempParam);
            self::$data[$field] = $val;
        }
        return $this;
    }


    /**
     * 验证
     * @param VerifyBase $verify
     * @param string $msg
     * @return $this
     */
    public function verify(VerifyBase $verify,  $msg='格式不正确'){
        foreach ($this->opList as $field) {
            if(!$verify->verify(self::$data[$field])){
                self::$error[$field][] = $msg;
            }
        }
        return $this;
    }

    /**
     * 函数验证
     * @param $fun 验证函数名 val作为第一个参数
     * @param $param  可选其他参数
     * @param string $msg
     * @return $this
     */
    public function verifyCall($fun,$param,$msg = '不正确'){
        foreach ($this->opList as $field) {
            $val = self::$data[$field];
            $tempParam = $param;
            array_unshift($tempParam,$val);
            if(!call_user_func_array($fun,$tempParam)){
                self::$error[$field][] = $msg;
            }
        }
        return $this;
    }

    /**
     * 正则验证
     * @param $regExpStr 正则表达式
     * @param $msg
     * @return $this
     */
    public function verifyRegExp($regExpStr,$msg = '不匹配'){
        foreach ($this->opList as $field) {
            if(!preg_match($regExpStr,self::$data[$field])){
                self::$error[$field][] = $msg;
            }
        }
        return $this;
    }


    /**
     * 比较 指定的参数
     * @param CompareBase $compare
     * @param $op1
     * @param $op2
     * @param string $msg
     * @return $this
     */
    public function compare(CompareBase $compare,$op1,$op2,$msg = '预期不符'){
        $op1 = isset(self::$data[$op1]) ? self::$data[$op1] : $op1;
        if(!is_array($op2)){
            $op2 = isset(self::$data[$op2]) ? self::$data[$op2] : $op2;
        }

        if(!$compare->compare($op1,$op2)) self::$error['compare'][] = $msg;
        return $this;
    }


    /**
     * 获取所有接受的参数
     * @return array
     */
    public function get(){
        return self::$data;
    }

    /**
     * 获取所有的参数值
     * @return array
     */
    public function getValues(){
        //可配合list语法使用
        return array_values(self::$data);
    }

    /**
     * 获取错误信息
     * @return array
     */
    public function getError(){
        return self::$error;
    }
}