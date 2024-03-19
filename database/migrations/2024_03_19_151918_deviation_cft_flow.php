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
        Schema::create('deviation_cft_workflow', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("division_id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("deviation_id");
            $table->unsignedBigInteger("cft_role_id");
            $table->string("review")->nullable();
            $table->unsignedBigInteger("person_id")->nullable()->comment("Person(users) who is responsible for this task");
            $table->string("assessment")->nullable();
            $table->string("feedback")->nullable();
            $table->string("attachment")->nullable();
            $table->string("completed_by")->nullable();
            $table->date("completed_on")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deviation_cft_workflow');
    }
};
