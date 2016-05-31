<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/10
 * Time: 上午12:07
 */
namespace Home\Controller;

use \Think\Upload;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!session('user.userId')) {
            redirect('/login');
        }
    }

    public function index()
    {
        $userId = session('user.userId');
        $kuangAccountModel = D('KuangAccount');
        $accountInfo = $kuangAccountModel->where(['user_id' => $userId])->find();
        $oreTotal = $accountInfo['ore_total'];

        $inviteCodeModel = D('KuangInviteCode');
        $inviteCodeInfo = $inviteCodeModel->where(['user_id' => $userId])->find();
        $inviteCode = $inviteCodeInfo['invite_code'];

        $kuangUserOremachineModel = D('KuangUserOremachine');
        $kuangUserOremachineCount = $kuangUserOremachineModel->where(['user_id' => $userId, 'residual_yield' => ['gt', 0], 'status' => 1 ,'effective_time' => ['lt',time()]])->count('id');//

        $kuangUserOremachineWaitCount = $kuangUserOremachineModel->where(['user_id' => $userId, 'residual_yield' => ['gt', 0], 'status' => 1 ,'effective_time' => ['gt',time()]])->count('id');

        $kuangOremachineManagerModel = D('KuangOremachineManager');
        $oreYield = $kuangOremachineManagerModel->getOreYield();

        $kuangUserCashModel = D('KuangOrder');
        $buyIngOremachineNum = $kuangUserCashModel->where(['user_id' => $userId , 'status' => 1])->sum('oremachine_num');

        $dayCount = $oreYield * $kuangUserOremachineCount;

        $kuangNoticeModel = D('KuangNotice');
        $noticeList = $kuangNoticeModel->field('id,title,create_time')->order('create_time DESC')->limit(7)->select();

        $kuangStatModel = D('KuangStatistics');
        $statList = $kuangStatModel->order('create_time DESC')->limit(7)->select();

        $viewData = [
            'oreTotal' => $oreTotal,
            'inviteCode' => $inviteCode,
            'kuangUserOremachineCount' => $kuangUserOremachineCount,
            'buyIngOremachineNum' => $buyIngOremachineNum,
            'kuangUserOremachineWaitCount' => $kuangUserOremachineWaitCount,
            'oreYield' => $oreYield,
            'dayCount' => $dayCount,
            'noticeList' => $noticeList,
            'statList' => $statList,
        ];

        $this->assign($viewData);

        $this->display();
    }


    public function info()
    {
        $userId = session('user.userId');
        $kuangUser = D('KuangUser');

        if (IS_POST) {
            $uploadObject = new Upload();
            $uploadObject->maxSize = 3145728;
            $uploadObject->exts = ['jpg', 'png', 'jpeg'];
            $uploadObject->rootPath = './Public/';
            $uploadObject->savePath = '/u/m/';
            $uploadObject->autoSub = true;
            $uploadObject->subName = ['date', 'Ymd'];
            $uploadInfo = $uploadObject->uploadOne($_FILES['photo']);
            if (!$uploadInfo) {// 上传错误提示错误信息
                $this->error($uploadObject->getError());
                exit;
            } else {// 上传成功 获取上传文件信息
                $path = $uploadInfo['savepath'] . $uploadInfo['savename'];
                $data = [
                    'money_img' => $path,
                ];
                $id = $kuangUser->where('id=' . $userId)->save($data);
                $this->success('上传成功', '/my-account/info');
                exit;
            }
        }

        $userInfo = $kuangUser->where(['id' => $userId])->find();
        $viewData = [
            'userInfo' => $userInfo,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function resetPassword()
    {
        $userId = session('user.userId');
        if (IS_POST) {
            $oldPassword = md5(I('post.oldPassword'));
            $newPassword = I('post.newPassword');
            $newPassword2 = I('post.newPassword2');
            $userModel = D('KuangUser');
            $userInfo = $userModel->where(['id' => $userId])->find();

            if ($oldPassword != $userInfo['password']) {
                $this->error('旧密码验证不通过');
                exit;
            }
            if ($newPassword != $newPassword2) {
                $this->error('两次密码输入不一致');
                exit;
            }
            if (strlen($newPassword) < 6 || strlen($newPassword) > 12) {
                $this->error('密码长度在6-12位之间');
                exit;
            }
            $data = [
                'password' => md5($newPassword),
            ];
            $id = $userModel->where('id=' . $userId)->save($data);
            if (!$id) {
                $this->error('密码修改失败');
                exit;
            }
            $this->success('密码修改成功', '/my-account', 2);
            exit;
        }
        $this->display();
    }


    public function myOremachine()
    {
        $userId = session('user.userId');
        $kuangUserOremachineModel = D('KuangUserOremachine');
        $kuangUserOremachineList = $kuangUserOremachineModel->where(['user_id' => $userId])->select();
        $viewData = [
            'kuangUserOremachineList' => $kuangUserOremachineList,
            'statusConf' => [
                0 => '封矿',
                1 => '正常',
                2 => '已产尽',
            ]
        ];

        $this->assign($viewData);
        $this->display();
    }
}