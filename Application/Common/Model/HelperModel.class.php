<?php
namespace Common\Model;

class HelperModel extends BaseModel
{
    public static $transaction = array();

    public static function startTransaction()
    {
        M()->startTrans();
    }

    public static function doTransactionRollback()
    {
        M()->rollback();
    }

    public static function doTransactionCommit()
    {
        M()->commit();
    }
}