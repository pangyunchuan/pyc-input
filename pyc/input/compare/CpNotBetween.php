<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:39
 */

namespace pyc\input\compare;

/**
 * 不在什么之间
 * Class CpNotBetween
 * @package pyc\input\compare
 */
class CpNotBetween extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 < min($v2) || $v2 > max($v2);
    }
}