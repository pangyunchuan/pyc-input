<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:35
 */

namespace pyc\input\compare;

/**
 * 大于
 * Class CpGt
 * @package pyc\input\compare
 */
class CpGt extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 > $v2;
    }
}