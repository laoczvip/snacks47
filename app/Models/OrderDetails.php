<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $table = "order_details";

    public function usergood()
    {
        return $this->hasMany('App\Models\GoodsSku','id','gid');
    }
}
