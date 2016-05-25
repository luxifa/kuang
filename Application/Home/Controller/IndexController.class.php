<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/9
 * Time: 下午10:22
 */
namespace Home\Controller;


class IndexController extends BaseController
{
    public function index()
    {
        $userId = session('user.userId');
        if(!$userId) $userId = '';
        $viewData = [
            'userId' => $userId,
        ];
        $this->assign($viewData);
        $this->display();
    }
}