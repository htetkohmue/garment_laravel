<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('name_mm');
            $table->string('name_en');
            $table->integer('phone_no');
            $table->string('email',50)->nullable();
            $table->string('nrc_no');
            $table->string('address');
            $table->string('township_id');
            $table->string('status');
            $table->string('description')->nullable();
            $table->timestamp('join_date')->useCurrent();
            $table->softDeletes();
            $table->integer('created_emp');
            $table->integer('updated_emp');
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
        Schema::dropIfExists('customers');
    }
}
