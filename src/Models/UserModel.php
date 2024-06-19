<?php
namespace Luan\Project1\Models;

use Luan\Project1\Models\BaseModel;

class UserModel extends BaseModel
{
    protected $tableName = "user";
    protected $fullname = "fullname";
    protected $email = "email";
    protected $tel = "tel";
    protected $address = "address";
    protected $avatar = "avatar";
    protected $password = "password";
    public static function getByEmailAndPassword($username, $password)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE username = :username AND password = :password ";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["username" => $username, "password" => $password];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }

    public static function getinfor($id)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName WHERE `id` = :$model->primaryKey";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        $data = ["$model->primaryKey" => $id];
        $stmt->execute($data);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    // public static function updateInfor($id,$email, $fullname,$tel,$address,$image_name,$password)
    // {
    //     $model = new static;
    //     $model->sqlBuilder = "UPDATE $model->tableName SET
    //     `$model->fullname` = ':fullname', `$model->email` = ':email',`$model->password` = ':password',
    //     `$model->tel` = ':tel', `$model->address` = ':address',`$model->avatar` = ':avatar'
    //     WHERE `user_id` = :$model->primaryKey";
    //     $data = [":$model->primaryKey" => $id,":fullname" => $fullname,":email" => $email,":password" => $password,
    //     ":tel" => $tel,":address" => $address,":avatar" => $image_name];
    //     $stmt = $model->conn->prepare($model->sqlBuilder);
    //     // dd($data);
    //     $stmt->execute($data);
    // }
    // public static function changePassword ($email,$password)
    // {
    //     $model = new static;
    //     $model->sqlBuilder = "UPDATE $model->tableName SET
    //     `$model->password` = ':password',
    //     WHERE `email` = :email";
    //     //Thêm $id vào data
    //     $data = [":email" => $email,":password" => $password,];
    //     $stmt = $model->conn->prepare($model->sqlBuilder);
    //     $stmt->execute($data);
    // }
    public static function getUserSearch($keyword, $role)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName ";
        if ($role != 'manager') {
            $model->sqlBuilder .= " WHERE $model->tableName.role != 'manager' AND $model->tableName.$model->email LIKE '%$keyword%' ";
        } else {
            $model->sqlBuilder .= " WHERE $model->tableName.email LIKE '%$keyword%";
        }
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
    public static function getUserSearchPagination($keyword, $start, $limit, $role)
    {
        $model = new static;
        $model->sqlBuilder = "SELECT * FROM $model->tableName";
        if (!empty($keyword) && $keyword != "") {
            if ($role != 'manager') {
                $model->sqlBuilder .= " WHERE $model->tableName.role != 'manager' AND $model->tableName.email LIKE '%$keyword%'";
            } else {
                $model->sqlBuilder .= " WHERE $model->tableName.email LIKE '%$keyword%";
            }
        }
        $model->sqlBuilder .= " LIMIT $start, $limit";
        $stmt = $model->conn->prepare($model->sqlBuilder);
        // $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }
}
