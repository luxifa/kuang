<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/27
 * Time: 下午10:18
 */
namespace Admin\Controller;

class StatController extends BaseController
{
    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 10;
        $kuangStatModel = D('KuangStatistics');
        $totalPage = ceil($kuangStatModel->count("id") / $pageNum);
        $statList = $kuangStatModel->order('create_time DESC')->page($pageNow, $pageNum)->select();
        $viewData = [
            'statList' => $statList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function create()
    {
        if (IS_POST) {
            $kuangStatModel = D('KuangStatistics');
            $sellTotal = I('post.sellTotal');
            $makeTotal = I('post.makeTotal');

            $data = [
                'sell_total' => $sellTotal,
                'make_total' => $makeTotal,
                'create_time' => time(),
            ];
            $id = $kuangStatModel->add($data);
            if (!$id) {
                $this->error('新建统计失败');
                exit;
            }
            $this->success('新建统计成功', '/admin/stat', 3);
            exit;
        }
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangStatModel = D('KuangStatistics');
        if (IS_POST) {
            $sellTotal = I('post.sellTotal');
            $makeTotal = I('post.makeTotal');
            $data = [
                'sell_total' => $sellTotal,
                'make_total' => $makeTotal,
            ];
            $id = $kuangStatModel->where('id=' . $id)->save($data);
            if (!$id) {
                $this->error('修改统计失败');
                exit;
            }
            $this->success('修改统计成功', '/admin/stat', 3);
            exit;
        }
        $statInfo = $kuangStatModel->where(['id' => $id])->find();
        $viewData = [
            'statInfo' => $statInfo,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function delete()
    {
        $id = (int)I('get.id');
        $kuangStatModel = D('KuangStatistics');
        $result = $kuangStatModel->where('id=' . $id)->delete();
        if (!$result) {
            $this->error('删除统计失败');
            exit;
        }
        $this->success('删除统计成功', '/admin/stat', 3);
    }
}