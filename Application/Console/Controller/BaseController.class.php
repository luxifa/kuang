<?php
/**
 * Created by PhpStorm.
 * User: cheungscary
 * Date: 16/5/24
 * Time: 下午9:25
 */
namespace Console\Controller;

use Think\Controller;

class BaseController extends Controller
{
    protected static function enterLock($pidFile)
    {
        $pidResource = fopen($pidFile, 'w+');
        if ($pidResource) {
            if (flock($pidResource, LOCK_EX | LOCK_NB)) {
                return $pidResource;
            }
            fclose($pidResource);
            $pidResource = null;
        }
        return false;
    }


    protected static function releaseLock($pidFile, $pidResource)
    {
        flock($pidResource, LOCK_UN);
        fclose($pidResource);
        unlink($pidFile);
    }


    public static function echoLog($log)
    {
        echo date('Y-m-d H:i:s') . " console " . $_SERVER['argv'][1] . " : {$log} \n";
    }
}