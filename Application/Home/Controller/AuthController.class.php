<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/10
 * Time: 上午12:03
 */
namespace Home\Controller;

use Common\Model\HelperModel;
use Common\Common\Util;
use Think\Verify;

class AuthController extends BaseController
{
    public function login()
    {
        if (IS_POST) {
            $userName = I('post.userName', '');
            $password = I('post.password', '');
            $verifyCode = I('post.verifyCode', '');

            if(!($this->verifyCheck($verifyCode))){
                $this->error('验证码错误');
                exit;
            }

            $userModel = D('KuangUser');
            $userInfo = $userModel->where(['user_name' => $userName])->find();
            if (!$userInfo || ($userInfo['password'] != md5($password))) {
                $this->error('用户名或密码错误');
                exit;
            }
            session('user.userId', $userInfo['id']);
            redirect('/my-account');
        }
        $this->display();
    }


    public function register()
    {
        if (IS_POST) {
            $userName = I('post.userName', '');
            $password = I('post.password', '');
            $password2 = I('post.password2', '');
            $inviteCode = I('post.inviteCode', '');
            $verifyCode = I('post.verifyCode', '');

            if(mb_strlen($userName) < 6 || mb_strlen($userName) > 13){
                $this->error('用户名长度不能小于6位或大于13位');
                exit;
            }

            if(!($this->verifyCheck($verifyCode))){
                $this->error('验证码错误');
                exit;
            }

            if ($password !== $password2) {
                $this->error('两次密码输入不一致');
                exit;
            }

            if (strlen($password) < 6 || strlen($password) > 12) {
                $this->error('密码长度在6-12位之间');
                exit;
            }

            if (empty($inviteCode)) {
                $this->error('邀请码不能为空');
                exit;
            }

            $inviteCodeModel = D('KuangInviteCode');
            $inviteCodeInfo = $inviteCodeModel->where(['invite_code' => $inviteCode])->find();
            if (!$inviteCodeInfo['invite_code']) {
                $this->error('邀请码错误');
                exit;
            }

            $userModel = D('KuangUser');
            $isUser = $userModel->where(['user_name' => $userName])->find();
            if($isUser){
                $this->error('此用户名已被注册');
                exit;
            }
            HelperModel::startTransaction();
            $user = [
                'user_name' => $userName,
                'password' => md5($password),
                'create_time' => time(),
            ];
            $data = $userModel->create($user);
            $userId = $userModel->add($data);
            if (!$userId) {
                HelperModel::doTransactionRollback();
                $this->error('注册失败');
                exit;
            }

            $userAccountModel = D('KuangAccount');
            $account = [
                'user_id' => $userId,
                'ore_total' => 0,
            ];
            $accountId = $userAccountModel->add($account);
            if (!$accountId) {
                HelperModel::doTransactionRollback();
                $this->error('注册失败');
                exit;
            }

            $userInviteCode = [
                'user_id' => $userId,
                'invite_code' => Util::getRandChar(5),
            ];
            $inviteCodeId = $inviteCodeModel->add($userInviteCode);
            if (!$inviteCodeId) {
                HelperModel::doTransactionRollback();
                $this->error('注册失败');
                exit;
            }

            if ($inviteCodeInfo['user_id']) {
                $friendModel = D('KuangFriend');
                $friend = [
                    'user_id' => $inviteCodeInfo['user_id'],
                    'friend_id' => $userId,
                    'create_time' => time(),
                ];
                $friendResultId = $friendModel->add($friend);
                if (!$friendResultId) {
                    HelperModel::doTransactionRollback();
                    $this->error('注册失败');
                    exit;
                }
            }
            HelperModel::doTransactionCommit();
            session('user.userId', $userId);
            redirect('/my-account');
        } else {
            $this->display();
        }

    }


    public function logout()
    {
        session('user.userId', null);
        redirect('/login');
    }


    public function verify()
    {
        $verifyObject = new Verify();
        $verifyObject->fontttf = '4.ttf';
        $verifyObject->length = 4;
        $verifyObject->entry();
    }

    protected function verifyCheck($verifyCode){
        $verifyObject = new Verify();
        $isVer = $verifyObject->check($verifyCode);
        return $isVer;
    }
}