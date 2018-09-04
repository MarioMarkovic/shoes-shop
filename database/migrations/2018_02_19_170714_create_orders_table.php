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
            $table->string('token', 191);
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191);
            $table->string('city', 191);
            $table->integer('post_number');
            $table->string('street_name', 191);
            $table->integer('street_number');
            $table->integer('phone');
            $table->integer('total_quantity')->unsigned();
            $table->decimal('total_price', 7,2);
            $table->tinyInteger('status')->default(1);
            $table->string('type_of_payment', 191);

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
