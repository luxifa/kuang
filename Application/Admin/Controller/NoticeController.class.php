<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/19
 * Time: 下午9:00
 */
namespace Admin\Controller;

class NoticeController extends BaseController
{
    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 10;
        $kuangNoticeModel = D('KuangNotice');
        $totalPage = ceil($kuangNoticeModel->count("id") / $pageNum);
        $noticeList = $kuangNoticeModel->field('id,title,create_time')->order('create_time DESC')->page($pageNow, $pageNum)->select();
        $viewData = [
            'noticeList' => $noticeList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
        ];
        $this->assign($viewData);
        $this->display();

    }


    public function create()
    {
        if (IS_POST) {
            $kuangNoticeModel = D('KuangNotice');
            $title = I('post.title');
            $content = I('post.content');

            $data = [
                'title' => $title,
                'content' => $content,
                'create_time' => time(),
            ];
            $id = $kuangNoticeModel->add($data);
            if (!$id) {
                $this->error('新建公告失败');
                exit;
            }
            $this->success('新建公告成功', '/admin/notice', 3);
        }
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangNoticeModel = D('KuangNotice');
        if (IS_POST) {
            $title = I('post.title');
            $content = I('post.content');
            $data = [
                'title' => $title,
                'content' => $content,
            ];
            $id = $kuangNoticeModel->where('id=' . $id)->save($data);
            if (!$id) {
                $this->error('修改公告失败');
                exit;
            }
            $this->success('修改公告成功', '/admin/notice', 3);
        }
        $noticeInfo = $kuangNoticeModel->where(['id' => $id])->find();
        $viewData = [
            'noticeInfo' => $noticeInfo,
        ];
        $this->assign($viewData);
        $this->display();
    }

    public function delete()
    {
        $id = (int)I('get.id');
        $kuangNoticeModel = D('KuangNotice');
        $result = $kuangNoticeModel->where('id=' . $id)->delete();
        if (!$result) {
            $this->error('删除公告失败');
            exit;
        }
        $this->success('删除公告成功', '/admin/notice', 3);
    }
}