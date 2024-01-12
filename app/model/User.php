<?php
namespace app\model;

use think\Model;

class User extends Model{
    protected $table = "user";

    public function getByUsername($username){
        return $this->where("username",$username)->find();
    }
}