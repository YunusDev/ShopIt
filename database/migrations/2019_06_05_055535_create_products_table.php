<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->integer('admin_id')->nullable();
            $table->string('slug');
            $table->decimal('price', 15, 2);
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('quantity');
            $table->longText('specs');
            $table->longText('brief');
            $table->longText('description');

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
        Schema::dropIfExists('products');
    }
}
