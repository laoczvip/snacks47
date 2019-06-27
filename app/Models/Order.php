<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = "order";


    // 个人中心订单详情
    public function orderdetails(){
        return $this->hasOne('App\Models\OrderDetails','oid');
    }

    /**
     * [用户收藏]
     * @return [type] [description]
     */


    public function address()
    {
        return $this->belongsToMany('App\Models\Address','order_details','oid','aid');
    }

}
