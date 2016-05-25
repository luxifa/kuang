<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/18
 * Time: 下午3:47
 */
namespace Home\Controller;

class ShopController extends BaseController
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
        $kuangUserOremachineModel = D('KuangUserOremachine');
        $kuangOremachineManagerModel = D('KuangOremachineManager');
        $userOremachineCount = $kuangUserOremachineModel->where(
            [
                'user_id' => $userId,
                'residual_yield' => [
                    'gt', 0
                ]
            ]
        )->count('id');

        $oreYield = $kuangOremachineManagerModel->getOreYield();

        $userAvgDayTotalOre = $userOremachineCount * $oreYield;
        $viewData = [
            'userOremachineCount' => $userOremachineCount,
            'oreYield' => $oreYield,
            'userAvgDayTotalOre' => $userAvgDayTotalOre,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function create()
    {
        if (IS_POST) {
            $unitPrice = 350;
            $buyOremachineNum = (int)I('post.oremachineNum');
            if ($buyOremachineNum <= 0 || $buyOremachineNum >= 100) {
                $this->error('购买数量不正确', '/shop');
                exit;
            }
            $totalPrice = ($unitPrice * $buyOremachineNum) - mt_rand(1, 10);
            session('user.buyOremachineNum', $buyOremachineNum);
            session('user.shouldPayPrice', $totalPrice);
            redirect('/payment');
        }
        $this->error('非法访问', '/shop');
    }


    public function payment()
    {
        $buyOremachineNum = session('user.buyOremachineNum');
        $totalPrice = session('user.shouldPayPrice');
        if (!$buyOremachineNum || !$totalPrice) {
            $this->error('请先选择矿机数量', '/shop');
        }
        if (IS_POST) {
            $wechatNickname = I('post.wechatNickname');
            if (!$wechatNickname) {
                $this->error('请输入微信昵称', '/payment');
                exit;
            }
            $userId = session('user.userId');
            $data = [
                'user_id' => $userId,
                'wechat_nickname' => $wechatNickname,
                'oremachine_num' => $buyOremachineNum,
                'payment_money' => $totalPrice,
                'create_time' => time(),
            ];
            $kuangOrder = D('KuangOrder');
            $id = $kuangOrder->add($data);
            if (!$id) {
                $this->error('提交失败,请重新提交', '/payment');
                exit;
            }
            session('user.buyOremachineNum', null);
            session('user.shouldPayPrice', null);
            $this->success('购买成功,请等待管理员审核', '/my-account');
            exit;
        }

        $kuangAdminModel = D('KuangAdmin');
        $adminInfo = $kuangAdminModel->find();
        $viewData = [
            'adminInfo' => $adminInfo,
            'totalPrice' => $totalPrice,
        ];
        $this->assign($viewData);
        $this->display();
    }
}