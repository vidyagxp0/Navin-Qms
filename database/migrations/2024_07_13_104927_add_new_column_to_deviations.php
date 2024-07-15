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
            //
            $table->text('rejected_comment')->nullable();
            $table->text('qa_more_info_required_comment')->nullable();
            $table->text('cft_more_info_required_by')->nullable();
            $table->text('cft_more_info_required_on')->nullable();
            $table->text('cft_more_info_required_comment')->nullable();
            $table->text('qa_head_more_info_required_by')->nullable();
            $table->text('qa_head_more_info_required_on')->nullable();
            $table->text('qa_head_more_info_required_comment')->nullable();
            $table->text('hod_final_more_info_required_by')->nullable();
            $table->text('hod_final_qa_more_info_required_on')->nullable(); 
            $table->text('hod_final_qa_more_info_required_comment')->nullable();
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
