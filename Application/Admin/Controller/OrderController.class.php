<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/19
 * Time: 上午12:35
 */
namespace Admin\Controller;

class OrderController extends BaseController
{
    public static $orderStatusConf = [
        0 => '无效订单',
        1 => '审核中的订单',
        2 => '审核通过',
    ];

    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 10;
        $kuangOrderModel = D('KuangOrder');
        $totalPage = ceil($kuangOrderModel->count("id") / $pageNum);
        $orderList = $kuangOrderModel
            ->field('kuang_order.*,kuang_user.user_name')
            ->join('kuang_user ON kuang_order.user_id=kuang_user.id')
            ->order('kuang_order.create_time DESC')
            ->page($pageNow, $pageNum)
            ->select();
        $viewData = [
            'orderList' => $orderList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
            'orderStatusConf' => self::$orderStatusConf,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangOrderModel = D('KuangOrder');
        if (IS_POST) {
            $orderStatus = (int)I('post.orderStatus');
            $data = [
                'status' => $orderStatus,
            ];
            $id = $kuangOrderModel->where('id=' . $id)->save($data);
            if (!$id) {
                $this->error('修改失败');
            }
            $this->success('修改成功', '/admin/order', 2);
        }
        $orderInfo = $kuangOrderModel
            ->field('kuang_order.*,kuang_user.user_name')
            ->where(['kuang_order.id' => $id])
            ->join('kuang_user ON kuang_order.user_id=kuang_user.id')
            ->find();
        $viewData = [
            'orderInfo' => $orderInfo,
            'orderStatusConf' => self::$orderStatusConf,
        ];
        $this->assign($viewData);
        $this->display();
    }

}