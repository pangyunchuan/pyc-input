<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:37
 */

namespace pyc\input\compare;

/**
 * 小于
 * Class CpLt
 * @package pyc\input\compare
 */
class CpLt extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 < $v2;
    }
}