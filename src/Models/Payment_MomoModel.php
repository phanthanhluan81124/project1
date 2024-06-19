<?php

namespace Luan\Project1\Models;

class Payment_MomoModel extends BaseModel{
    protected $tableName = 'payment_momo';
    protected $orderId = 'orderId';

    public static function getPaymentSearch($keyword)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE $model->tableName.$model->orderId = :keyword ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [':keyword' => $keyword];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getPaymentSearchPagination($keyword, $start, $limit)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        if (!empty($keyword) && $keyword != "") {
                $model->sqlBuilder .= " WHERE  $model->tableName.$model->orderId = :keyword";
            }
        $model->sqlBuilder .= " LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        if((!empty($keyword) && $keyword != "")){
            $data = [':keyword' => $keyword];
            $stmt->execute($data);
        }
        else{
            $stmt->execute();
        }
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}