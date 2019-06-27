<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    public $table = 'collect';

    public $timestamps = false;

    public function goods_skus()
    {
        return $this->hasMany('App\Models\GoodsSku','gid');
    }

}
