<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/19
 * Time: 上午11:27
 */
namespace Home\Controller;

use Common\Model\HelperModel;

class SellController extends BaseController
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
        $kuangAccount = D('KuangAccount');
        $accountInfo = $kuangAccount->where(['user_id' => $userId])->find();
        if (IS_POST) {
            $oreNum = (int)I('post.oreNum',0);
            if ($accountInfo['ore_total'] <= 0 || $accountInfo['ore_total'] < $oreNum) {
                $this->error('矿数不够,不能提现', '/my-account');
                exit;
            }

            if ($oreNum <= 0) {
                $this->error('请输入正确的数量', '/my-account');
                exit;
            }

            $kuangCash = D('KuangCash');
            $lastCashInfo = $kuangCash->where(['user_id' => $userId])->order('create_time DESC')->find();
            $nowTimeStamp = time();
            $nowYear = date('Y', $nowTimeStamp);
            $nowMonth = date('m', $nowTimeStamp);
            $lastYear = date('Y', $lastCashInfo['create_time']);
            $lastMonth = date('m', $lastCashInfo['create_time']);
            if (($nowYear == $lastYear) && ($nowMonth == $lastMonth)) {
                $this->error('每月只能卖出一次', '/my-account');
                exit;
            }
            $kuangUser = D('KuangUser');
            $userInfo = $kuangUser->where(['id' => $userId, 'status' => 1])->find();
            if (!$userInfo) {
                $this->error('不具有卖出资格', '/my-account');
                exit;
            }
            if (!$userInfo['money_img']) {
                $this->error('请先上传微信收款二维码', '/my-account/info');
                exit;
            }

            HelperModel::startTransaction();
            $cashData = [
                'user_id' => $userId,
                'cash_ore' => $oreNum,
                'create_time' => $nowTimeStamp,
            ];
            $cashId = $kuangCash->add($cashData);
            if (!$cashId) {
                HelperModel::doTransactionRollback();
                $this->error('卖出矿石失败,请重试', '/my-account');
                exit;
            }

            $accountData = [
                'ore_total' => $accountInfo['ore_total'] - $oreNum,
            ];
            $AccId = $kuangAccount->where(['user_id' => $userId, 'id' => $accountInfo['id']])->save($accountData);
            if (!$AccId) {
                HelperModel::doTransactionRollback();
                $this->error('卖出矿石失败,请重试', '/my-account');
                exit;
            }

            HelperModel::doTransactionCommit();
            $this->success('卖出矿石成功,请等待工作人员审核', '/my-account');
            exit;
        }
        $viewData = [
            'oreTotal' => $accountInfo['ore_total'],
        ];
        $this->assign($viewData);
        $this->display();
    }
}