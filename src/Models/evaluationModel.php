<?php

namespace Luan\Project1\Models;
use PDO;
class EvaluationModel extends BaseModel
{
    protected $tableName = 'evaluation';
    protected $primaryKey = 'evaluation_id';
    protected $tableNameJoin = 'user';

    public static function allEvaluation()
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM `$model->tableName` 
        JOIN  $model->tableNameJoin ON `$model->tableNameJoin`.id = $model->tableName.$model->primaryKey
        ORDER BY `$model->tableName`.$model->primaryKey DESC LIMIT 0, 5";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
}