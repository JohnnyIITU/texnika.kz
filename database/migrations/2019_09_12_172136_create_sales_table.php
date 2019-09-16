<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city');
            $table->integer('mark');
            $table->string('model', '55');
            $table->integer('year');
            $table->integer('type');
            $table->integer('curr');
            $table->integer('price');
            $table->enum('status', ['active','trash','deactive']);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('description', 1000);
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
        Schema::dropIfExists('sales');
    }
}
