<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17 0017
 * Time: 10:37
 */

namespace pyc\input\verify;


class VerUrl extends VerifyBase
{
    public function verify($val)
    {
        return filter_var($val,FILTER_VALIDATE_URL);
    }
}