<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 16:36
 */

namespace pyc\input\compare;


class CpEGt extends CompareBase
{
    public function compare($v1, $v2)
    {
        return $v1 >= $v2;
    }
}