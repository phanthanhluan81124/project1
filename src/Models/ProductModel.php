<?php
namespace Luan\Project1\Models;

use Luan\Project1\Models\BaseModel;

class ProductModel extends BaseModel
{
    protected $tableName = "products";
    protected $category = "category_id";
    protected $product = "id";

    public static function getProductHot()
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*,  ROUND(AVG(evaluation.number_stars), 0) AS rating
        FROM $model->tableName  
        LEFT JOIN evaluation ON $model->tableName.$model->primaryKey = evaluation.product_id 
        WHERE $model->tableName.highlight = 1 AND $model->tableName.status = 1 
        GROUP BY $model->tableName.$model->primaryKey";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getProductNew()
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(evaluation.number_stars), 0) AS rating
        FROM  $model->tableName
        LEFT JOIN evaluation ON $model->tableName.$model->primaryKey = evaluation.product_id 
        WHERE $model->tableName.status = 1
        GROUP BY $model->tableName.$model->primaryKey 
        ORDER BY $model->tableName.created_at DESC LIMIT 0,8";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getProductSearch($keyword)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(evaluation.number_stars), 0) AS rating
        FROM  $model->tableName
        LEFT JOIN evaluation ON $model->tableName.$model->primaryKey = evaluation.product_id 
        WHERE $model->tableName.status = 1 AND product_name LIKE '%$keyword%'
        GROUP BY $model->tableName.$model->primaryKey";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getProductSearchPagination($keyword, $start, $limit, $price)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(evaluation.number_stars), 0) AS rating
        FROM  $model->tableName
        LEFT JOIN evaluation ON $model->tableName.$model->primaryKey = evaluation.product_id 
        WHERE $model->tableName.status = 1 ";
        if(!empty($keyword) && $keyword !=""){
        $model->sqlBuilder .= " AND product_name LIKE '%$keyword%'";
        }
        $model->sqlBuilder .= " GROUP BY $model->tableName.$model->primaryKey";
        if(!empty($price) && $price !=""){
        $model->sqlBuilder .= " ORDER BY $model->tableName.product_price $price";
        }
        $model->sqlBuilder .= " LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getAllProduct($start, $limit, $price)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(evaluation.number_stars), 0) AS rating
        FROM  $model->tableName
        LEFT JOIN evaluation ON $model->tableName.$model->primaryKey = evaluation.product_id 
        WHERE $model->tableName.status = 1 
        GROUP BY $model->tableName.$model->primaryKey 
        ORDER BY $model->tableName.product_price $price LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getEvaluation($category, $id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(eva.number_stars), 0) AS rating
        FROM  $model->tableName 
        LEFT JOIN evaluation  as eva ON $model->tableName.$model->primaryKey = eva.product_id 
        WHERE $model->tableName.status = 1 and $model->tableName.category_id =:$model->category and $model->tableName.id != :$model->primaryKey
        GROUP BY $model->tableName.$model->primaryKey   
        ORDER BY $model->tableName.$model->primaryKey  DESC ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id, "$model->category" => $category];
        $stmt->execute($data);

        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getEvaluationCategory($product, $id, $start, $limit, $price)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT $model->tableName.*, ROUND(AVG(eva.number_stars), 0) AS rating
        FROM  $model->tableName 
        LEFT JOIN evaluation  as eva ON $model->tableName.$model->primaryKey = eva.product_id 
        WHERE $model->tableName.status = 1 and $model->tableName.category_id =:$model->primaryKey 
        GROUP BY $model->tableName.$model->product 
        ORDER BY $model->tableName.product_price $price LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id, "$model->product" => $product];
        $stmt->execute($data);

        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getComment($id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT eva.*,user.* ,ROUND(AVG(eva.number_stars), 0) AS rating ,COUNT(eva.evaluation_id) AS comments
        FROM  evaluation as eva 
        LEFT JOIN user ON user.id = eva.user_id 
        WHERE eva.product_id =:$model->primaryKey
        GROUP BY eva.evaluation_id 
        ORDER BY eva.evaluation_id  DESC ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id];
        $stmt->execute($data);

        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function updateProduct($id,$data)
    {
        $model = new static;
        $model->sqlBuilder = "UPDATE `$model->tableName` SET ";

        foreach ($data as $key => $value) {
            $model->sqlBuilder .= "`$key`=:$key, ";
        }

        $model->sqlBuilder = rtrim($model->sqlBuilder, ", ");
        //Thêm điều kiện để cập nhật
        $model->sqlBuilder .= " WHERE $model->primaryKey =:$model->primaryKey";

        //Thêm $id vào data
        $data["$model->primaryKey"] = $id;
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute($data);
    }

}
