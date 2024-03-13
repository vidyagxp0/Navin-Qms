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
        Schema::create('deviations', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            //$table->string('division_code')->nullable();
            $table->string('initiator_group_code')->nullable();
            $table->date('intiation_date')->nullable();
            $table->string('form_type')->nullable();
            $table->integer('record_number')->nullable();
            //$table->string('text')->nullable();
            $table->integer('assign_to')->nullable();
            $table->date('due_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->longText('short_description')->nullable();
            $table->date('Deviation_reported_date')->nullable();
            $table->string('Observed_by')->nullable();
            $table->string('audit_type')->nullable();
            $table->longText('Name_of_Product')->nullable();
            $table->longText('Description_Deviation')->nullable();
            $table->longText('Immediate_action')->nullable();
            $table->longText('Preliminary_impact')->nullable();
            $table->longText('Product_Details_Required')->nullable();
            $table->longText('HOD_Remarks')->nullable();
            $table->string('Deviation_category')->nullable();
            $table->longText('Justification_for_categorization')->nullable();
            $table->string('Investigation_required')->nullable();
            $table->longText('Investigation_Details')->nullable();
            $table->string('Customer_notification_required')->nullable();
            $table->string('customers')->nullable();
            $table->longText('QAInitialRemark')->nullable();
            $table->longText('Investigation_Summary')->nullable();
            $table->longText('Impact_assessment')->nullable();
            $table->longText('Root_cause')->nullable();
            $table->string('CAPA_Rquired')->nullable();
            $table->string('capa_type')->nullable();
            $table->longText('CAPA_Description')->nullable();
            $table->longText('QA_Feedbacks')->nullable();
            $table->longText('Closure_Comments')->nullable();
            $table->longText('Disposition_Batch')->nullable();
            $table->longText('Audit_file')->nullable();
            $table->longText('Initial_attachment')->nullable();
            $table->longText('QA_attachment')->nullable();
            $table->longText('Investigation_attachment')->nullable();
            $table->longText('Capa_attachment')->nullable();

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
        Schema::dropIfExists('deviations');
    }
};
