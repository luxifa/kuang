<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/18
 * Time: 下午6:10
 */
namespace Common\Model;

class KuangOremachineManagerModel extends BaseModel
{
    protected $tableName = 'kuang_oremachine_manager';

    public function getOreYield()
    {
        $oreYield = 60;
        $time = strtotime(date("Y-m-d", strtotime("now")));
        $oreYieldResult = $this->field('ore_yield')->where(['effective_time' => $time, 'status' => 1])->find();
        if (!$oreYieldResult) {
            $oreYieldResultList = $this->field('ore_yield,effective_time')->where(['ore_yield' => ['gt', 0], 'status' => 1])->order('effective_time DESC')->limit(2)->select();
            if (count($oreYieldResultList) > 1) {
                if ($oreYieldResultList[0]['effective_time'] > $time) {
                    $oreYield = $oreYieldResultList[1]['ore_yield'];
                } else {
                    $oreYield = $oreYieldResultList[0]['ore_yield'];
                }
            } else {
                $oreYield = $oreYieldResultList[0]['ore_yield'];
            }
        } else {
            $oreYield = $oreYieldResult['ore_yield'];
        }
        return $oreYield;
    }
}