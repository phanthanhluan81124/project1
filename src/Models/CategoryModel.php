<?php
namespace Luan\Project1\Models;
use Luan\Project1\Models\BaseModel;

class CategoryModel extends BaseModel
{
    protected $tableName = "categories";

    public static function getCategorySearch($keyword)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM  $model->tableName WHERE category_name LIKE '%$keyword%'";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getCategorySearchPagination($keyword, $start, $limit)
    {
        $model = new static; 
        $model->sqlBuilder = "SELECT * FROM  $model->tableName";
        if(!empty($keyword) && $keyword != ""){
            $model->sqlBuilder .= " WHERE category_name LIKE '%$keyword%'";
        }
        $model->sqlBuilder .= " LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}
