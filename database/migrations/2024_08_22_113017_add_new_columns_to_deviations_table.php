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
        Schema::table('deviations', function (Blueprint $table) {
            $table->string('qa_more_info_required_email')->nullable();
            $table->string('rejected_email')->nullable();
            $table->string('qa_head_more_info_required_email')->nullable();
            $table->string('cft_more_info_required_email')->nullable();
            $table->string('hod_final_more_info_required_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deviations', function (Blueprint $table) {
            //
        });
    }
};
