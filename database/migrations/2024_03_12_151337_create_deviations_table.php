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
            $table->integer('record')->nullable();
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
            $table->string('short_description_required')->nullable();
            $table->string('nature_of_repeat')->nullable();
            $table->date('Deviation_date')->nullable();
            $table->date('Deviation_reported_date')->nullable();
            $table->string('Facility')->nullable();
            $table->string('audit_type')->nullable();
            $table->longText('others')->nullable();
            $table->longText('Product_Batch')->nullable();
            $table->longText('Description_Deviation')->nullable();
            $table->longText('Immediate_Action')->nullable();
            $table->longText('Preliminary_Impact')->nullable();
            $table->longText('Product_Details_Required')->nullable();
            $table->longText('HOD_Remarks')->nullable();
            $table->string('Deviation_category')->nullable();
            $table->longText('Justification_for_categorization')->nullable();
            $table->string('Investigation_required')->nullable();
            $table->longText('Investigation_Details')->nullable();
            $table->string('Customer_notification')->nullable();
            $table->string('customers')->nullable();
            $table->longText('QAInitialRemark')->nullable();
            $table->longText('Investigation_Summary')->nullable();
            $table->longText('Impact_assessment')->nullable();
            $table->longText('Root_cause')->nullable();
            $table->string('CAPA_Rquired')->nullable();
            $table->string('capa_type')->nullable();
            $table->longText('CAPA_Description')->nullable();
            $table->longText('Post_Categorization')->nullable();
            $table->longText('Investigation_Of_Review')->nullable();
            $table->longText('QA_Feedbacks')->nullable();
            $table->longText('Closure_Comments')->nullable();
            $table->longText('Disposition_Batch')->nullable();
            $table->longText('Audit_file')->nullable();
            $table->longText('Initial_attachment')->nullable();
            $table->longText('QA_attachment')->nullable();
            $table->longText('Investigation_attachment')->nullable();
            $table->longText('Capa_attachment')->nullable();
            $table->longText('QA_attachments')->nullable();
            $table->longText('closure_attachment')->nullable();

            $table->string('plan_proposed_by')->nullable();
            $table->string('plan_proposed_on')->nullable();
            $table->string('Plan_approved_on')->nullable();
            $table->string('plan_approved_by')->nullable();
            $table->string('completed_by')->nullable();
            $table->string('completed_on')->nullable();
            $table->string('qa_more_info_required_on')->nullable();
            $table->string('qa_more_info_required_by')->nullable();
            $table->string('cancelled_on')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('approved_on')->nullable();
            $table->string('approved_by')->nullable();

            $table->string('rejected_on')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
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
