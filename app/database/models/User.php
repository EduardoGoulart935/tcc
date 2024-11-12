<?php

namespace app\database\models;

use app\database\Connect;

class User extends Model
{
    protected string $table = 'usuarios';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(firstName,lastName,email,avatar) values(:firstName,:lastName,:email,:avatar)");

            return $prepare->execute($data);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }
}