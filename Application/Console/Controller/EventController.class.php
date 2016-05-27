<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/24
 * Time: 下午8:04
 */
namespace Console\Controller;

use Common\Model\HelperModel;

class EventController extends BaseController
{
    public function make()
    {
        $pidFile = '/web/pids/kuang_make.pid';
        $pidResource = self::enterLock($pidFile);
        if (!$pidResource) {
            self::echoLog('已经有进程运行中...');
            exit();
        }
        self::echoLog('脚本启动!');
        while (true) {
            $nowTime = time();
            if (empty($alreadyMakeUserList)) {
                $alreadyMakeUserList = [];
            }
            $kuangUserOremachineModel = D('KuangUserOremachine');
            $userIdList = $kuangUserOremachineModel->field('distinct user_id')->select();
            $userIdList = array_column($userIdList, 'user_id');
            $makeUserIdList = array_diff($userIdList, $alreadyMakeUserList);
            $userId = array_shift($makeUserIdList);
            $userOremachineInfo = $kuangUserOremachineModel
                ->field('kuang_user_oremachine.id,kuang_user_oremachine.user_id, kuang_user_oremachine.residual_yield, kuang_user_oremachine.lately_make_time')
                ->join('kuang_user ON kuang_user.id=kuang_user_oremachine.user_id AND kuang_user.status=1')
                ->where(['kuang_user_oremachine.residual_yield' => ['gt', 0], 'kuang_user_oremachine.user_id' => $userId, 'kuang_user_oremachine.status' => 1, 'kuang_user_oremachine.effective_time' => ['lt', $nowTime]])
                ->select();
	  
            if ($userOremachineInfo) {
                $kuangOremachineManagerModel = D('KuangOremachineManager');
                $oreYield = $kuangOremachineManagerModel->getOreYield();
                $makeCount = 0;
                HelperModel::startTransaction();
                foreach ($userOremachineInfo as $userOremachineRow) {
                    if (strtotime(date("Y-m-d", $userOremachineRow['lately_make_time'])) < strtotime(date("Y-m-d",time()))) {
                        $makeRow = $userOremachineRow['residual_yield'] > $oreYield ? $oreYield : $userOremachineRow['residual_yield'];
                        $makeCount += $makeRow;
                        $updateRowData = [
                            'residual_yield' => $userOremachineRow['residual_yield'] - $makeRow,
                            'lately_make_time' => time(),
                        ];
                        $resultUpdateRow = $kuangUserOremachineModel->where('id=' . $userOremachineRow['id'])->save($updateRowData);
                        if (!$resultUpdateRow) {
                            self::echoLog('矿机 ' . $userOremachineRow['id'] . ' 生产矿失败');
                            HelperModel::doTransactionRollback();
                            continue 2; //##################################修改为2
                        }
                        $makeTime = strtotime(date("Y-m-d",time()));
                    }
	
                }
                if ($makeCount > 0) {
                    $kuangAccountModel = D('KuangAccount');
                    $accountInfo = $kuangAccountModel->where(['user_id' => $userId])->find();
                    $updateAccountData = [
                        'ore_total' => $accountInfo['ore_total'] + $makeCount,
                    ];
                    $resultUpdateCount = $kuangAccountModel->where('user_id=' . $userId)->save($updateAccountData);
                    if (!$resultUpdateCount) {
                        self::echoLog('用户 ' . $userId . ' 生产矿失败');
                        HelperModel::doTransactionRollback();
                        continue 1; //##################################修改为1
                    }
                }
                HelperModel::doTransactionCommit();
            }
            array_push($alreadyMakeUserList, $userId);
            if(isset($makeTime) && (strtotime(date("Y-m-d",time())) > $makeTime)){
                unset($alreadyMakeUserList);
            }
            sleep(5);
        }
        self::releaseLock($pidFile, $pidResource);
    }
}
