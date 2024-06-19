<?php
namespace Luan\Project1\Models;

use Luan\Project1\Models\BaseModel;

class ProductDetail extends BaseModel
{
    protected $tableName = "products_detail";
    protected $primaryKey = 'product_detail_id';

    public static function updateQuantity($id,$product_quantity)
    {
        $model= new static;

        $model->sqlBuilder = "UPDATE `$model->tableName` SET
        `product_quantity` = :product_quantity
        WHERE `product_detail_id` =  :$model->primaryKey ";
        $data = ["$model->primaryKey"=>$id,":product_quantity"=>$product_quantity];
        $sttm = $model->conn->prepare($model->sqlBuilder);
        $sttm->execute($data);
    }
    public static function updateDetail($id,$product_quantity,$product_size)
    {
        $model= new static;

        $model->sqlBuilder = "UPDATE `$model->tableName` SET
        `product_quantity` = :product_quantity,`product_size` = :product_size
        WHERE `product_detail_id` =  :$model->primaryKey ";
        $data = ["$model->primaryKey"=>$id,":product_quantity"=>$product_quantity,":product_size"=>$product_size];
        $sttm = $model->conn->prepare($model->sqlBuilder);
        $sttm->execute($data);
    }

    
}
