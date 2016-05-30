<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/19
 * Time: 下午1:19
 */
namespace Admin\Controller;

class CashController extends BaseController
{

    public static $cashStatusConf = [
        0 => '无效提现',
        1 => '审核中的提现',
        2 => '提现审核通过',
    ];

    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 10;
        $kuangCashModel = D('KuangCash');
        $totalPage = ceil($kuangCashModel->count("id") / $pageNum);
        $cashList = $kuangCashModel
            ->field('kuang_cash.*,u1.user_name,u2.user_name as sj_name')
            ->join('kuang_user as u1 ON kuang_cash.user_id=u1.id')
            ->join('LEFT JOIN kuang_friend ON kuang_friend.friend_id=u1.id')
            ->join('LEFT JOIN kuang_user as u2 ON kuang_friend.user_id=u2.id')
            ->order('kuang_cash.create_time DESC')
            ->page($pageNow, $pageNum)
            ->select();

        $viewData = [
            'cashList' => $cashList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
            'cashStatusConf' => self::$cashStatusConf,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangCashModel = D('KuangCash');
        if (IS_POST) {
            $cashStatus = (int)I('post.cashStatus');
            $data = [
                'status' => $cashStatus,
            ];
            $id = $kuangCashModel->where('id=' . $id)->save($data);
            if (!$id) {
                $this->error('修改失败');
                exit;
            }
            $this->success('修改成功', '/admin/cash', 2);
            exit;
        }
        $cashInfo = $kuangCashModel
            ->field('kuang_cash.*,kuang_user.user_name,kuang_user.money_img')
            ->where(['kuang_cash.id' => $id])
            ->join('kuang_user ON kuang_cash.user_id=kuang_user.id')
            ->find();
        $viewData = [
            'cashInfo' => $cashInfo,
            'cashStatusConf' => self::$cashStatusConf,
        ];
        $this->assign($viewData);
        $this->display();
    }
}