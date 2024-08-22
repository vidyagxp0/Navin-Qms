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
        Schema::create('deviation_logs', function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->json('data'); // Store JSON data
            $table->unsignedBigInteger('deviation_id');
            $table->foreign('deviation_id')->references('id')->on('deviations')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('deviation_logs');
    }
    

};
