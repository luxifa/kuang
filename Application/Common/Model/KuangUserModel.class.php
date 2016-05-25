<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/18
 * Time: 上午10:34
 */
namespace Common\Model;

class KuangUserModel extends BaseModel
{
    protected $tableName = 'kuang_user';

    protected $_validate = [
        ['user_name', 'require', '用户名不能为空!'],  // 都有时间都验证
        ['user_name', '', '用户名已经存在', 0, 'unique', 1],  // 只在登录时候验证
        ['user_name', '/^[a-zA-Z][a-zA-Z0-9_]{5,12}$/', '用户名不合法！'], // 只在登录时候验证
    ];
}