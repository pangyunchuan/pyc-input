<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 09:43
 */

namespace pyc\input\compare;


class CpBetween extends CompareBase
{
    public function compare($v1, $v2)
    {
        return min($v2) <= $v1 && $v1 <= max($v2);
    }
}