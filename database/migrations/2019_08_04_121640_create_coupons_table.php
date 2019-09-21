<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code');
            $table->text('description')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->string('type')->default('percentage');
            $table->bigInteger('discount')->default(20); // by percentage or price
            $table->bigInteger('max_usage')->default(10);
            $table->bigInteger('remaining')->nullable();
            $table->boolean('will_expire')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamp('expires_in')->nullable();
            $table->timestamps();
        });



        Schema::create('coupon_user', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id');

//            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

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
        Schema::dropIfExists('coupons');
    }
}
