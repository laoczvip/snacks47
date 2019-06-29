<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = "order";


    // 个人中心订单详情
    public function orderdetails(){
        return $this->hasMany('App\Models\OrderDetails','oid');
    }

    /**
     * [ 用户地址 ]
     * @return [type] [description]
     */

    public function addresss()
    {
        return $this->hasOne('App\Models\Address','id','aid');
    }

}
