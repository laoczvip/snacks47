<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Usersinfo extends Model
{
    public $table = "user_info";

    use SoftDeletes;
}
