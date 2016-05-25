<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/9
 * Time: 下午10:50
 */
namespace Admin\Controller;


class IndexController extends BaseController
{
    public function index()
    {
        $kuangUserModel = D('KuangUser');
        $kuangCashModel = D('KuangCash');
        $kuangOrderModel = D('KuangOrder');
        $todayTime = strtotime(date("Y-m-d", strtotime("now")));
        $todayCountUser = $kuangUserModel->where(['create_time' => ['gt',$todayTime]])->count('id');
        $notHandleCashCount = $kuangCashModel->where(['status' => 1])->count('id');
        $notHandleOrderCount = $kuangOrderModel->where(['status' => 1])->count('id');
        $viewData = [
            'todayCountUser' => $todayCountUser,
            'notHandleCashCount' => $notHandleCashCount,
            'notHandleOrderCount' => $notHandleOrderCount,
        ];
        $this->assign($viewData);
        $this->display();
    }

}