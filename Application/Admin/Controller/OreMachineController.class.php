<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/18
 * Time: 下午4:48
 */
namespace Admin\Controller;


class OreMachineController extends BaseController
{
    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 5;
        $kuangOremachineManagerModel = D('KuangOremachineManager');
        $totalPage = ceil($kuangOremachineManagerModel->count("id") / $pageNum);
        $oremachineList = $kuangOremachineManagerModel->where(['status' => 1])->order('effective_time DESC')->page($pageNow, $pageNum)->select();
        $viewData = [
            'oremachineList' => $oremachineList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
        ];
        $this->assign($viewData);
        $this->display();
    }


    public function create()
    {
        if (IS_POST) {
            $kuangOremachineManagerModel = D('KuangOremachineManager');
            $effectiveTime = strtotime(date("Y-m-d", strtotime("+1 day")));
            $oreManagerInfo = $kuangOremachineManagerModel->where(['effective_time' => $effectiveTime, 'status' => 1]);
            if ($oreManagerInfo) {
                $this->error('明天的矿产量已经设置过,请勿重复设置');
            }
            $oreNum = (int)I('post.oreNum',50);
            $data = [
                'ore_yield' => $oreNum,
                'create_time' => time(),
                'effective_time' => $effectiveTime,
            ];
            $id = $kuangOremachineManagerModel->add($data);
            if (!$id) {
                $this->error('设置失败');
                exit;
            }
            $this->success('设置成功', '/admin/oremachine', 3);
        }
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangOremachineManagerModel = D('KuangOremachineManager');
        if (IS_POST) {
            $oreNum = (int)I('post.oreNum',50);
            $data = [
                'ore_yield' => $oreNum,
            ];
            $id = $kuangOremachineManagerModel->where('id='.$id)->save($data);
            if (!$id) {
                $this->error('修改失败');
                exit;
            }
            $this->success('修改成功', '/admin/oremachine', 3);
        }
        $oreManagerInfo = $kuangOremachineManagerModel->where(['id' => $id])->find();
        $viewData = [
            'oreManagerInfo' => $oreManagerInfo,
        ];
        $this->assign($viewData);
        $this->display();
    }

}