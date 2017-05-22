<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19 0019
 * Time: 15:22
 */

namespace pyc\input\verify;


class VerPath extends VerifyBase
{
    public function verify($val)
    {
        return preg_match('/^[A-Za-z0-9_\/-]+[A-Za-z0-9_\.-]*([\\\\\/][A-Za-z0-9_-]+[A-Za-z0-9_\.-]*)*$/',$val);
    }
}