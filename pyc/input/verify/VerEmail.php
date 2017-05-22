<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17 0017
 * Time: 10:34
 */

namespace pyc\input\verify;


class VerEmail extends VerifyBase
{
    public function verify($val)
    {
        return filter_var($val,FILTER_VALIDATE_EMAIL);
    }
}