<?php

namespace Luan\Project1\Models;

class VoucherModel extends BaseModel
{
    protected $tableName = 'voucher';
    protected $primaryKey = 'voucher_id';
    protected $code = 'code';

    public static function getVoucherSearch($keyword)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE $model->tableName.$model->code LIKE '%$keyword%' ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $data = ['keyword' => $keyword];
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getVoucherSearchPagination($keyword, $start, $limit)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        if (!empty($keyword) && $keyword != "") {
            $model->sqlBuilder .= " WHERE $model->tableName.$model->code LIKE '%$keyword%'";
        }
        $model->sqlBuilder .= " LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // if ((!empty($keyword) && $keyword != "")) {
        //     $data = [':keyword' => $keyword];
        //     $stmt->execute($data);
        // } else {
            $stmt->execute();
        // }
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}
