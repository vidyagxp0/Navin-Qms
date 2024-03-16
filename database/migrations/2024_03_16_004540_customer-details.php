<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer-details', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('email');
            $table->string('customer_type');
            $table->string('status');
            $table->string('customer_name');
            $table->string('contact_no');
            $table->string('industry');
            $table->string('region');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('customer-details');
    }
};
