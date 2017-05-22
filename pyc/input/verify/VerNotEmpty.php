<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17 0017
 * Time: 10:32
 */

namespace pyc\input\verify;


class VerNotEmpty extends VerifyBase
{
    public function verify($val)
    {
        return !empty($val);
    }
}