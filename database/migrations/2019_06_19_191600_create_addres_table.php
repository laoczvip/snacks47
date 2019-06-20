<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addres', function (Blueprint $table) {
            $table->increments('id')->comment('排序');
            $table->integer('uid')->comment('用户id');
            $table->string('address','255')->comment('地址');
            $table->char('atel', 11)->comment('联系电话');
            $table->char('consignee', 22)->comment('收货人');
            $table->enum('default', ['0', '1']);comment('是否设为默认地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addres');
    }
}
