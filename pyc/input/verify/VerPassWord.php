<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 14:21
 */

namespace pyc\input\verify;


class VerPassWord extends VerifyBase
{
    public function verify($val)
    {
        return preg_match('/^[a-z0-9_-]{6,18}$/',$val);
    }
}