<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 09:37
 */

namespace pyc\input\compare;


class CpNeq extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 != $v2;
    }
}