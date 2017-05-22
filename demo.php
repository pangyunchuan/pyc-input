<?php
use pyc\input\compare\CpEq;
use pyc\input\filter\FilterEmail;
use pyc\input\input\Input;
use pyc\input\verify\VerNotEmpty;
use pyc\input\verify\VerPath;
echo '<pre>';
error_reporting ( E_ALL );
ini_set('display_errors','on');
$sorce = array(
//            'name'=>' aabcdef ',
    'url'=>' url/1 ',
    'pass'=>' 23456 ',
    'pass2'=>'http://www.baidu.com',
    'email'=>'8974gkasldf48376@qq.com sdfa',
);
$sorce2 = array(
    'pass3'=>'123456789',
    'pass4'=>'1740'
);
// filter 过滤器;
//verify 验证器;
// compare 比较器,具体使用,看具体控制器

$input = Input::obj()->sorce($sorce)->recive('name')
    //从数据源 $scorce  接收name ,url ,pass pass2 参数,, name 没有,使用默认值 不设置,默认的默认值 null
    ->sorce($sorce)//不传参数,试用$_request 作数据源
    //接收多个 [['field','default']]
    ->reciveMore([['name','defaultName'],['url'],['pass'],['email']])
    //从数据源 $scorce  接收 pass2 参数,, pass2 没有,设置默认值 aaaa
    //接收单个
    ->recive('pass2','aaaaa')
    //从数据源 $scorce2  接收 pass3 参数,, pass4 没有,设置默认值 aaaa
    ->sorce($sorce2)->reciveMore([['pass3'],['pass4']])

    //两种过滤方式  过滤器(转换器), 回调方法
    //用过滤回调方法  使用 trim 方法过滤 所有接收的数据  回调
    ->setOpField()->filterCall('trim',array())
    //用email 过滤器 过滤 email
    ->setOpField('email')->filter(FilterEmail::obj(),array())

    //三种验证方式,,验证器,回调(第一个参数必为 输入字段的值,,),正则
    //用 VerPath 验证器 验证url字段,不正确,记录错误信息 msg
    ->setOpField('url')->verify(VerPath::obj(),'不是path')
    //用验证回调方法  使用 is_string 方法验证 name 是字符串, 不是记录错误信息
    ->setOpField('name')->verifyCall('is_string','不能为空',array())
    //用正则 /^[a-z0-9_-]{6,18}$/ 验证pass3,pass,,,不正确,记录错误信息 msg
    ->setOpField('pass3,pass')->verifyRegExp('/^[a-z0-9_-]{6,18}$/','6-18位字母或数字')

    //一个比较方法
    //比较pass,pass2
    ->compare(CpEq::obj(),'pass','pass2','两次密码不一致')
    ->compare(CpEq::obj(),'pass','pass2','两次密码不一致')
    ->setOpField('pass,pass3')->filterCall('md5')
    //获取处理后的接收参数
    ->get();

//获取错误信息
if($inputError = Input::obj()->getError()){
    var_dump($inputError);
}

//获取处理后的 接收数据
var_dump(Input::obj()->getValues());

var_dump($input);