<?php

namespace Luan\Project1\Models;

class CartDetailModel extends BaseModel
{
    protected $tableName = 'cart_detail';
    
    protected $primaryKey = 'cart_detail_id';

    public static function updateDetail($id, $data)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE `$model->tableName` SET ";

        foreach ($data as $key => $value) {
            $model->sqlBuilder .= "`$key`=:$key, ";
        }

        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");
        //Thêm điều kiện để cập nhật
        $model->sqlBuilder .= " WHERE $model->primaryKey=:$model->primaryKey";

        //Thêm $id vào data
        $data["$model->primaryKey"] = $id;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
    }
}