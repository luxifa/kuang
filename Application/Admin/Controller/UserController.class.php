<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/19
 * Time: 下午5:20
 */
namespace Admin\Controller;

class UserController extends BaseController
{
    public static $userStatusConf = [
        0 => '封号',
        1 => '正常',
    ];

    public function index()
    {
        $pageNow = (int)I('get.page', 1);
        $pageNum = 10;
        $kuangUserModel = D('KuangUser');
        $totalPage = ceil($kuangUserModel->count("id") / $pageNum);
        $userList = $kuangUserModel->alias('u1')
            ->field('u1.*, kuang_account.ore_total, kuang_invite_code.invite_code, count(kuang_user_oremachine.id) as oremachine_num, u2.user_name as sj_name')
            ->join('LEFT JOIN kuang_account ON u1.id=kuang_account.user_id')
            ->join('LEFT JOIN kuang_invite_code ON u1.id=kuang_invite_code.user_id')
            ->join('LEFT JOIN kuang_user_oremachine ON u1.id=kuang_user_oremachine.user_id AND kuang_user_oremachine.residual_yield > 0')
            ->join('LEFT JOIN kuang_friend ON kuang_friend.friend_id=u1.id')
            ->join('LEFT JOIN kuang_user as u2 ON kuang_friend.user_id=u2.id')
            ->group('u1.id')
            ->page($pageNow, $pageNum)
            ->select();
        $viewData = [
            'userList' => $userList,
            'totalPage' => $totalPage,
            'pageNow' => $pageNow,
            'userStatusConf' => self::$userStatusConf,
        ];

        $this->assign($viewData);
        $this->display();
    }


    public function update()
    {
        $id = (int)I('get.id');
        $kuangUserModel = D('KuangUser');
        $userInfo = $kuangUserModel
            ->field('kuang_user.*, kuang_account.ore_total, count(kuang_user_oremachine.id) as oremachine_num')
            ->join('LEFT JOIN kuang_account ON kuang_user.id=kuang_account.user_id')
            ->join('LEFT JOIN kuang_user_oremachine ON kuang_user.id=kuang_user_oremachine.user_id AND kuang_user_oremachine.residual_yield > 0')
            ->where(['kuang_user.id' => $id])
            ->find();
        if (IS_POST) {
            $userStatus = (int)I('post.userStatus');
            $oreTotal = (int)I('post.oreTotal');
            $addOremachineNum = (int)I('post.addOremachineNum');

            if ($userInfo['ore_total'] != $oreTotal) {
                $kuangAccount = D('KuangAccount');
                $oreTotalData = [
                    'ore_total' => $oreTotal,
                ];
                $accountId = $kuangAccount->where(['user_id' => $id])->save($oreTotalData);
                if (!$accountId) {
                    $this->error('修改用户总矿量失败');
                    exit;
                }
            }

            if ($userInfo['status'] != $userStatus) {
                $userData = [
                    'status' => $userStatus,
                ];
                $userId = $kuangUserModel->where(['id' => $id])->save($userData);
                if (!$userId) {
                    $this->error('修改用户状态失败');
                    exit;
                }
            }

            if ($addOremachineNum > 0) {
                $kuangUserOremachine = D('KuangUserOremachine');
                $addOremachineData = [];
                $nowTime = time();
                $effectiveTime = strtotime(date("Y-m-d", strtotime("+1 day")));

                for ($i = 0; $i < $addOremachineNum; $i++) {
                    $addOremachineRow = [
                        'user_id' => $id,
                        'residual_yield' => 7200,
                        'effective_time' => $effectiveTime,
                        'create_time' => $nowTime,
                    ];
                    array_push($addOremachineData, $addOremachineRow);
                }
                $result = $kuangUserOremachine->addAll($addOremachineData);
                if (!$result) {
                    $this->error('用户矿机失败');
                    exit;
                }
            }

            $this->success('操作成功', '/admin/user', 2);
            exit;

        }

        $viewData = [
            'userInfo' => $userInfo,
            'userStatusConf' => self::$userStatusConf,
        ];
        $this->assign($viewData);
        $this->display();

    }
}