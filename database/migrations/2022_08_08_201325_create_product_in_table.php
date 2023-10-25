<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_in', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('tailor_id');
            $table->integer('product_id')->comment('foreign Key from products');
            $table->integer('size_id');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('total_amount');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_in');
    }
}
