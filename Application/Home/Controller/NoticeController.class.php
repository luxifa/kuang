<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/25
 * Time: 下午1:23
 */
namespace Home\Controller;

class NoticeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if (!session('user.userId')) {
            redirect('/login');
        }
    }

    public function detail()
    {
        $id = I('get.id');
        $kuangNoticeModel = D('KuangNotice');
        $noticeInfo = $kuangNoticeModel->where(['id' => $id])->find();
        if(!$noticeInfo){
            $this->error('没有找到内容');
            exit;
        }
        $viewData = [
            'noticeInfo' => $noticeInfo,
        ];
        $this->assign($viewData);
        $this->display();
    }
}