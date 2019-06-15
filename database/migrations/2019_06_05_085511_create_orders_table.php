<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('total_price');
            $table->integer('profile_id')->nullable();
            $table->string('medium')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('Name');
            $table->string('email');
            $table->bigInteger('phone');
            $table->string('address');
            $table->string('local_govt');
            $table->string('state');
            $table->text('comment');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
