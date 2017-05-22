<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/18 0018
 * Time: 14:32
 */

namespace pyc\input\filter;

/**
 * 过滤email数据
 * Class FilterEmail
 * @package pyc\input\filter
 */
class FilterEmail extends FilterBase
{
    public function filter($val)
    {
        return filter_var($val,FILTER_SANITIZE_EMAIL);
    }
}