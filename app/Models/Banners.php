<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banners extends Model
{
    //
    // use SoftDeletes;
    use SoftDeletes;

    public $table = 'banners';
}
