<?php

namespace Luan\Project1\Models;

class OrderModel extends BaseModel
{
    protected $tableName = 'order';

    protected $tableNameJoin = 'order_detail';

    protected $primaryKey = 'order_id';
    protected $key;

    public static function insertOrder($user_id, $fullname, $email, $tel, $address, $total, $total_discount, $payment_method, $status ,$note)
    {
        $model = new static;
        $model->sqlBuilder = "INSERT INTO `$model->tableName`
        ( `user_id`, `fullname`, `email`, `tel`, `address`, `total`, `total_discount`, `payment_method`, `status`,`note`) 
        VALUES (:user_id, :fullname, :email, :tel, :address, :total, :total_discount, :payment_method,:status,:note)";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":user_id" => $user_id, ":fullname" => $fullname, ":email" => $email, ":tel" => $tel, ":address" => $address, ":total" => $total, ":total_discount" => $total_discount, ":payment_method" => $payment_method, ":status" => $status,":note" => $note];
        $stmt->execute($data);
        return $model->conn->lastInsertId();

    }
    public static function insertOrderDetail($order_id, $product_detail_id, $product_price, $product_quantity)
    {
        $model = new static;
        $model->sqlBuilder = "INSERT INTO `$model->tableNameJoin` (`order_id`, `product_detail_id`, `price`, `quantity`) 
        VALUES (:order_id, :product_detail_id, :product_price, :product_quantity)";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":order_id" => $order_id, ":product_detail_id" => $product_detail_id, ":product_price" => $product_price, ":product_quantity" => $product_quantity];
        $stmt->execute($data);
        return $model->conn->lastInsertId();
    }
    public static function getOrderDetail($id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM `$model->tableNameJoin`
        JOIN `products_detail` ON `products_detail`.`product_detail_id` = `$model->tableNameJoin`.`product_detail_id`
        JOIN `products` ON `products`.`id` = `products_detail`.`product_id`
        WHERE `$model->tableNameJoin`.$model->primaryKey = :$model->primaryKey";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;

    }
    public static function getOrder($id, $start, $limit)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM `$model->tableName`
        WHERE `$model->tableName`.`user_id` = :$model->primaryKey LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;

    }
    public static function checkComment($id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT `products`.id FROM `$model->tableName`
        JOIN `$model->tableNameJoin` ON `$model->tableNameJoin`.`$model->primaryKey` = `$model->tableName`.`$model->primaryKey`
        JOIN `products_detail` ON `products_detail`.`product_detail_id` = `$model->tableNameJoin`.`product_detail_id`
        JOIN `products` ON `products`.`id` = `products_detail`.`product_id`
        WHERE `$model->tableName`.user_id = :$model->primaryKey";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function cancelOrder($id, $status)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE `$model->tableName` SET `status` = ':status' WHERE `$model->tableName`.`$model->primaryKey` =:$model->primaryKey ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = [":$model->primaryKey" => $id, ":status" => $status];
        $stmt->execute($data);
    }
    public static function getOrderSearch($keyword,$date,$pending)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM `$model->tableName` ";
        if ($keyword != ''&& $date == "" && $pending == "") {
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword' ";
        }
        if($date != "" && $keyword == '' ){
            $model->sqlBuilder .= "WHERE $model->tableName.created_at = '$date'";
        }
        else if($date != "" && $keyword != '' ){
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword' AND $model->tableName.created_at = '$date'";
        }
        if($pending != "" && $keyword == '' ){
            $model->sqlBuilder .= "WHERE $model->tableName.status = '$pending'";
        }
        else if($pending != "" && $keyword != '' ){
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword' AND $model->tableName.status = '$pending'";
        }
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getOrderSearchPagination($keyword,$orderToday,$orderPending,$start, $limit)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM `$model->tableName` ";
        if($keyword != "" && $orderToday == "" && $orderPending == ""){
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword'";
        }
        else if($keyword != "" && $orderToday != "" && $orderPending == ""){
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword' AND $model->tableName.created_at = '$orderToday' ";
        }
        else if($keyword != "" && $orderToday == "" && $orderPending != ""){
            $model->sqlBuilder .= " WHERE $model->tableName.tel = '$keyword' AND $model->tableName.status = '$orderPending' ";
        }
        else if($keyword == "" && $orderToday != "" && $orderPending == ""){
            $model->sqlBuilder .= " WHERE $model->tableName.created_at = '$orderToday' " ;
        } 
        else if($keyword == "" && $orderToday == "" && $orderPending != "" ){
            $model->sqlBuilder .= " WHERE $model->tableName.status = '$orderPending' " ;
        }
        if($keyword == "" && $orderToday == "" && $orderPending == ""){
            $model->sqlBuilder .= " WHERE $model->primaryKey ORDER BY $model->primaryKey DESC LIMIT $start, $limit";
        }
        else if($keyword != "" || $orderToday != "" || $orderPending != ""){
            $model->sqlBuilder .= " AND $model->primaryKey ORDER BY $model->primaryKey DESC LIMIT $start, $limit";
        }
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }

}