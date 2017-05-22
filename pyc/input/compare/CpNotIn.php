<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:39
 */

namespace pyc\input\compare;


class CpNotIn extends CompareBase
{
    public function compare($v1, $v2)
    {
        return !in_array($v1,$v2);
    }
}