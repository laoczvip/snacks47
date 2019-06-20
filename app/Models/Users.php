<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    // 设置表名
    public $table = "users";

    // 软删除
    use SoftDeletes;

    // 用户详情
    public function userinfo(){
        return $this->hasOne('App\Models\Usersinfo','uid');
    }
    /**
     * 用户地址
     * @return [type] [description]
     */
    public function useraddres(){
        return $this->hasOne('App\Models\Address','uid');
    }


}
