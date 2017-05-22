<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:38
 */

namespace pyc\input\compare;

/**
 * 小于等于
 * Class CpELt
 * @package pyc\input\compare
 */
class CpELt extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 <= $v2;
    }
}