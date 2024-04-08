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
            $table->string('customer_id')->nullable();
            $table->string('email')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('status')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('industry')->nullable();
            $table->string('region')->nullable();
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
