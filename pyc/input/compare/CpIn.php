<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 09:38
 */

namespace pyc\input\compare;


class CpIn extends CompareBase
{
    public function compare($v1, $v2)
    {
        return in_array($v1,$v2);
    }
}