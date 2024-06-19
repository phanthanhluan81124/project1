<?php

namespace Luan\Project1\Models;

class CartModel extends BaseModel
{
    protected $tableName = 'cart';
    protected $tableNameJoin = 'cart_detail';
    protected $primaryKey = 'user_id';
    protected $primaryKeyJoin = 'cart_detail_id';
    protected $cart = 'cart_id';
    protected $tableOrder = 'order';


    public static function getCart($id)
    {
        $model = new static;

        $model->sqlBuilder = "SELECT $model->tableName .*,$model->tableNameJoin.*,pd.product_id,pd.product_quantity as quantityProductDetail,pro.* ,$model->tableNameJoin.status as statusCart FROM $model->tableName 
        JOIN $model->tableNameJoin ON $model->tableName.cart_id  = $model->tableNameJoin.cart_id
        JOIN products_detail as pd ON $model->tableNameJoin.product_detail_id = pd.product_detail_id 
        JOIN products as pro ON pd.product_id = pro.id WHERE $model->tableName.$model->primaryKey = :$model->primaryKey " ;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getSumCart($id)
    {
        $model = new static;

        $model->sqlBuilder = "SELECT $model->tableName .*,$model->tableNameJoin.*,pd.product_id,pd.product_quantity as quantityProductDetail,pro.* FROM $model->tableName 
        JOIN $model->tableNameJoin ON $model->tableName.cart_id  = $model->tableNameJoin.cart_id
        JOIN products_detail as pd ON $model->tableNameJoin.product_detail_id = pd.product_detail_id 
        JOIN products as pro ON pd.product_id = pro.id WHERE $model->tableName.$model->primaryKey = :$model->primaryKey AND  $model->tableNameJoin.status > 0" ;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getCartOrder($id)
    {
        $model = new static;

        $model->sqlBuilder = "SELECT $model->tableName .*,$model->tableNameJoin.*,pd.product_id,pd.product_quantity as quantityProductDetail,pro.* FROM $model->tableName 
        JOIN $model->tableNameJoin ON $model->tableName.cart_id  = $model->tableNameJoin.cart_id
        JOIN products_detail as pd ON $model->tableNameJoin.product_detail_id = pd.product_detail_id 
        JOIN products as pro ON pd.product_id = pro.id WHERE $model->tableName.$model->primaryKey = :$model->primaryKey AND $model->tableNameJoin.`status` = 1 " ;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function insertCart($user_id)
    {
        $model = new static;
        $model->sqlBuilder = "INSERT INTO `$model->tableName` ( `user_id`) VALUES (:user_id)";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":user_id" => $user_id];
        $stmt->execute($data);
    }
    public static function insertCartDetail($data)
    {
        $model = new static;

        $columnNames = ""; //Dùng để lưu trữ tên cột của câu lệnh SQL
        $paramName = ""; //Dùng để lưu trữ tham số của câu lệnh SQL

        foreach ($data as $key => $value) {
            $columnNames .= "`$key`, ";
            $paramName .= ":$key, ";
        }

        //Xóa dấu ", " trong $columnNames và $paramName
        $columnNames = rtrim($columnNames, ", ");
        $paramName = rtrim($paramName, ", ");

        //Hoàn thiện câu lệnh SQL INSERT
        $model->sqlBuilder = "INSERT INTO $model->tableNameJoin( $columnNames ) VALUES( $paramName )";

        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
        //trả lại giá trị khóa vừa thêm
        return $model->conn->lastInsertId();
    }
    public static function deleteCart($id)
    {
        $model = new static;
        $model->sqlBuilder = "DELETE FROM $model->tableNameJoin WHERE $model->tableNameJoin .$model->primaryKeyJoin=:$model->primaryKeyJoin";
        $stmt = $model->conn->prepare($model->sqlBuilder);

        //Truyền tham số
        $stmt->bindParam(":$model->primaryKeyJoin", $id);
        $stmt->execute();
    }

    public static function resetCart($id)
    {
        $model = new static;
        $model->sqlBuilder = "DELETE FROM `$model->tableNameJoin` WHERE `$model->primaryKeyJoin` = :id";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
    public static function updateCartDetail($id, $data)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE `$model->tableNameJoin` SET ";

        foreach ($data as $key => $value) {
            $model->sqlBuilder .= "`$key`=:$key, ";
        }

        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");
        //Thêm điều kiện để cập nhật
        $model->sqlBuilder .= " WHERE `product_detail_id`=:id";

        //Thêm $id vào data
        $data[":id"] = $id;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function updateCart($id, $quantity, $status)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE `$model->tableNameJoin` SET `$model->tableNameJoin`.`product_quantity` = :quantity, `$model->tableNameJoin`.`status` = :status WHERE `product_detail_id`=:id";
         $data = [":id"=>$id,":quantity"=>$quantity,":status" =>$status];
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}