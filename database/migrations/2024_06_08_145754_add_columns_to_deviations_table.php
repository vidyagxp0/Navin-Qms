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
            $table->longText('initiator_final_remarks')->nullable();
            $table->longText('initiator_final_attachments')->nullable();
            $table->longText('hod_final_remarks')->nullable();
            $table->longText('hod_final_attachments')->nullable();
            $table->longText('qa_final_remarks')->nullable();
            $table->longText('qa_final_attachments')->nullable();

            $table->string('Initiator_Update_By')->nullable();
            $table->string('Initiator_Update_On')->nullable();
            $table->longText('Initiator_Update_Comments')->nullable();

            $table->string('HOD_Final_Review_By')->nullable();
            $table->string('HOD_Final_Review_On')->nullable();
            $table->longText('HOD_Final_Review_Comments')->nullable();

            $table->string('QA_Final_Review_By')->nullable();
            $table->string('QA_Final_Review_On')->nullable();
            $table->longText('QA_Final_Review_Comments')->nullable();

            $table->string('QA_Final_Approval_By')->nullable();
            $table->string('QA_Final_Approval_On')->nullable();
            $table->longText('QA_Final_Approval_Comments')->nullable();
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
            $table->longText('initiator_final_remarks')->nullable();
            $table->longText('initiator_final_attachments')->nullable();
            $table->longText('hod_final_remarks')->nullable();
            $table->longText('hod_final_attachments')->nullable();
            $table->longText('qa_final_remarks')->nullable();
            $table->longText('qa_final_attachments')->nullable();
        });
    }
};
