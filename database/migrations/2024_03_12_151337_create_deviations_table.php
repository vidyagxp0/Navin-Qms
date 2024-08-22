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
            $table->tinyText('division_id')->nullable();
            $table->tinyText('initiator_group_code')->nullable();
            $table->text('intiation_date')->nullable();
            $table->string('form_type')->nullable();
            $table->integer('record_number')->nullable();
            $table->integer('assign_to')->nullable();
            $table->string('due_date')->nullable();
            $table->string('deviation_time')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->string('short_description')->nullable();
            $table->string('short_description_required')->nullable();
            $table->longText('nature_of_repeat')->nullable();
            $table->text('Deviation_date')->nullable();
            $table->text('Deviation_reported_date')->nullable();
            $table->string('Facility')->nullable();
            $table->string('Capachild')->nullable();
            $table->string('Rootchild')->nullable();
            $table->string('effectivenesschild')->nullable();
            $table->string('Changecontrolchild')->nullable();
            $table->string('actionchild')->nullable();
            $table->string('Extensionchild')->nullable();
            $table->string('audit_type')->nullable();
            $table->longText('others')->nullable();
            $table->string('Facility_Equipment')->nullable();
            $table->string('Document_Details_Required')->nullable();
            $table->longText('Description_Deviation')->nullable();
            $table->string('Related_Records1')->nullable();
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
            $table->tinyText('deviation_id')->nullable();
            $table->longText('QAInitialRemark')->nullable();
           
            $table->longText('Investigation_Summary')->nullable();
            $table->longText('Impact_assessment')->nullable();
            $table->longText('Root_cause')->nullable();
            // $table->string('CAPA_Rquired')->nullable();
            // $table->string('capa_type')->nullable();
            // $table->longText('CAPA_Description')->nullable();
            $table->longText('Post_Categorization')->nullable();
            $table->longText('Investigation_Of_Review')->nullable();
            $table->longText('QA_Feedbacks')->nullable();
            $table->longText('Closure_Comments')->nullable();
            $table->longText('Disposition_Batch')->nullable();
            $table->longText('Audit_file')->nullable();
            $table->longText('Initial_attachment')->nullable();
            $table->longText('QA_attachment')->nullable();
            // $table->longText('Investigation_attachment')->nullable();
            // $table->longText('Capa_attachment')->nullable();
            $table->longText('QA_attachments')->nullable();
            $table->longText('closure_attachment')->nullable();

            $table->string('submit_on')->nullable();
            $table->string('submit_by')->nullable();
            $table->longText('submit_comment')->nullable();
            $table->string('HOD_Review_Complete_By')->nullable();
            $table->string('HOD_Review_Complete_On')->nullable();
            $table->longText('HOD_Review_Comments')->nullable();
            $table->string('QA_Initial_Review_Complete_By')->nullable();
            $table->string('QA_Initial_Review_Complete_On')->nullable();
            $table->longText('QA_Initial_Review_Comments')->nullable();
            $table->string('QA_Final_Review_Complete_By')->nullable();
            $table->string('QA_Final_Review_Complete_On')->nullable();
            $table->longText('QA_Final_Review_Comments')->nullable();
            $table->string('CFT_Review_Complete_By')->nullable();
            $table->string('CFT_Review_Complete_On')->nullable();
            $table->longText('CFT_Review_Comments')->nullable();
             
            $table->string('qa_more_info_required_by')->nullable();
            $table->string('qa_more_info_required_on')->nullable();
            $table->string('Approved_By')->nullable();
            $table->string('Approved_On')->nullable();
            $table->longText('Approved_Comments')->nullable();

            $table->string('cancelled_on')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->string('rejected_on')->nullable();
            $table->string('rejected_by')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            $table->string('form_progress')->nullable();

            $table->longText('initiator_final_remarks')->nullable();
            $table->text('initiator_final_attachments')->nullable();
            $table->longText('hod_final_remarks')->nullable();
            $table->text('hod_final_attachments')->nullable();
            $table->longText('qa_final_remarks')->nullable();
            $table->text('qa_final_attachments')->nullable();

            $table->string('Initiator_Update_By')->nullable();
            $table->string('Initiator_Update_On')->nullable();
            $table->longText('Initiator_Update_Comments')->nullable();

            $table->string('HOD_Final_Review_By')->nullable();
            $table->string('HOD_Final_Review_On')->nullable();
            $table->longText('HOD_Final_Review_Comments')->nullable();

            $table->string('QA_Final_Review_By')->nullable();
            $table->string('QA_Final_Review_On')->nullable();
            // $table->longText('QA_Final_Review_Comments')->nullable();

            $table->string('QA_Final_Approval_By')->nullable();
            $table->string('QA_Final_Approval_On')->nullable();
            $table->longText('QA_Final_Approval_Comments')->nullable();


            $table->string('Conclusion')->nullable();
            $table->string('Identified_Risk')->nullable();
            $table->string('severity_rate')->nullable();
            $table->string('Occurrence')->nullable();
            $table->string('detection')->nullable();
            $table->string('capa_required')->nullable();
            $table->string('qrm_required')->nullable();
            // $table->string('Post_Categorization')->nullable();

            $table->longText('initial_file')->nullable();
            $table->longText('Delay_Justification')->nullable();
            $table->longText('Discription_Event')->nullable();
            $table->longText('objective')->nullable();
            $table->longText('scope')->nullable();
            $table->longText('imidiate_action')->nullable();
            $table->longText('imidiate_action1')->nullable();

            //attention_issues

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
