<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/9
 * Time: 下午11:12
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class AuthController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $adminUser = I('post.aduser', '');
            $password = I('post.password', '');
            $verifyCode = I('post.verifyCode', '');

            $adminModel = D('KuangAdmin');
            $adminInfo = $adminModel->where(['user_name' => $adminUser])->find();
            if (!$adminInfo || ($adminInfo['password'] != md5($password))) {
                $this->error('用户名或密码错误');
                exit;
            }

            $verifyObject = new Verify();
            $isVer = $verifyObject->check($verifyCode);
            if (!$isVer) {
                $this->error('验证码错误');
                exit;
            }

            session('isAdmin', $adminInfo['id']);
            redirect('/admin');
        }
        $this->display();
    }


    public function verify()
    {
        $verifyObject = new Verify();
        $verifyObject->entry();
    }


    public function logout()
    {
        session('isAdmin', null);
        redirect('/admin/login');
    }


}