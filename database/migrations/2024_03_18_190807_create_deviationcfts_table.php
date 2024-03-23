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
        Schema::create('deviationcfts', function (Blueprint $table) {
            $table->id();
            $table->integer('deviation_id');
            $table->text('Production_Review')->nullable();
            $table->text('Production_person')->nullable();
            $table->string('Production_assessment')->nullable();
            $table->string('Production_feedback')->nullable();
            $table->longText('production_attachment')->nullable();
            $table->string('Production_by')->nullable();
            $table->date('production_on')->nullable();

            $table->text('Warehouse_review')->nullable();
            $table->text('Warehouse_notification')->nullable();
            $table->string('Warehouse_assessment')->nullable();
            $table->string('Warehouse_feedback')->nullable();
            $table->longText('Warehouse_attachment')->nullable();
            $table->string('Warehouse_by')->nullable();
            $table->date('Warehouse_on')->nullable();

            $table->text('Quality_review')->nullable();
            $table->text('Quality_Control_Person')->nullable();
            $table->string('Quality_Control_assessment')->nullable();
            $table->string('Quality_Control_feedback')->nullable();
            $table->longText('Quality_Control_attachment')->nullable();
            $table->string('Quality_Control_by')->nullable();
            $table->date('Quality_Control_on')->nullable();

            $table->text('Quality_Assurance_Review')->nullable();
            $table->text('QualityAssurance_person')->nullable();
            $table->string('QualityAssurance_assessment')->nullable();
            $table->string('QualityAssurance_feedback')->nullable();
            $table->longText('Quality_Assurance_attachment')->nullable();
            $table->string('QualityAssurance_by')->nullable();
            $table->date('QualityAssurance_on')->nullable();

            $table->text('Engineering_review')->nullable();
            $table->text('Engineering_person')->nullable();
            $table->string('Engineering_assessment')->nullable();
            $table->string('Engineering_feedback')->nullable();
            $table->longText('Engineering_attachment')->nullable();
            $table->string('Engineering_by')->nullable();
            $table->date('Engineering_on')->nullable();

            $table->text('Analytical_Development_review')->nullable();
            $table->text('Analytical_Development_person')->nullable();
            $table->string('Analytical_Development_assessment')->nullable();
            $table->string('Analytical_Development_feedback')->nullable();
            $table->longText('Analytical_Development_attachment')->nullable();
            $table->string('Analytical_Development_by')->nullable();
            $table->date('Analytical_Development_on')->nullable();

            $table->text('Kilo_Lab_review')->nullable();
            $table->text('Kilo_Lab_person')->nullable();
            $table->string('Kilo_Lab_assessment')->nullable();
            $table->string('Kilo_Lab_feedback')->nullable();
            $table->longText('Kilo_Lab_attachment')->nullable();
            $table->string('Kilo_Lab_attachment_by')->nullable();
            $table->date('Kilo_Lab_attachment_on')->nullable();

            $table->text('Technology_transfer_review')->nullable();
            $table->text('Technology_transfer_person')->nullable();
            $table->string('Technology_transfer_assessment')->nullable();
            $table->string('Technology_transfer_feedback')->nullable();
            $table->longText('Technology_transfer_attachment')->nullable();
            $table->string('Technology_transfer_by')->nullable();
            $table->date('Technology_transfer_on')->nullable();

            $table->text('Environment_Health_review')->nullable();
            $table->text('Environment_Health_Safety_person')->nullable();
            $table->string('Health_Safety_assessment')->nullable();
            $table->string('Health_Safety_feedback')->nullable();
            $table->longText('Environment_Health_Safety_attachment')->nullable();
            $table->string('Environment_Health_Safety_by')->nullable();
            $table->date('Environment_Health_Safety_on')->nullable();

            $table->text('Human_Resource_review')->nullable();
            $table->text('Human_Resource_person')->nullable();
            $table->string('Human_Resource_assessment')->nullable();
            $table->string('Human_Resource_feedback')->nullable();
            $table->longText('Human_Resource_attachment')->nullable();
            $table->string('Human_Resource_by')->nullable();
            $table->date('Human_Resource_on')->nullable();

            $table->text('Information_Technology_review')->nullable();
            $table->text('Information_Technology_person')->nullable();
            $table->string('Information_Technology_assessment')->nullable();
            $table->string('Information_Technology_feedback')->nullable();
            $table->longText('Information_Technology_attachment')->nullable();
            $table->string('Information_Technology_by')->nullable();
            $table->date('Information_Technology_on')->nullable();

            $table->text('Project_management_review')->nullable();
            $table->text('Project_management_person')->nullable();
            $table->string('Project_management_assessment')->nullable();
            $table->string('Project_management_feedback')->nullable();
            $table->longText('Project_management_attachment')->nullable();
            $table->string('Project_management_by')->nullable();
            $table->date('Project_management_on')->nullable();

            $table->text('Other1_review')->nullable();
            $table->text('Other1_person')->nullable();
            $table->text('Other1_Department_person')->nullable();
            $table->text('Other1_assessment')->nullable();
            $table->text('Other1_feedback')->nullable();
            $table->longText('Other1_attachment')->nullable();
            $table->text('Other1_by')->nullable();
            $table->date('Other1_on')->nullable();

            $table->text('Other2_review')->nullable();
            $table->text('Other2_person')->nullable();
            $table->text('Other2_Department_person')->nullable();
            $table->text('Other2_Assessment')->nullable();
            $table->text('Other2_feedback')->nullable();
            $table->longText('Other2_attachment')->nullable();
            $table->text('Other2_by')->nullable();
            $table->date('Other2_on')->nullable();

            $table->text('Other3_review')->nullable();
            $table->text('Other3_person')->nullable();
            $table->text('Other3_Department_person')->nullable();
            $table->text('Other3_Assessment')->nullable();
            $table->string('Other3_feedback')->nullable();
            $table->longText('Other3_attachment')->nullable();
            $table->text('Other3_by')->nullable();
            $table->date('Other3_on')->nullable();

            $table->text('Other4_review')->nullable();
            $table->text('Other4_person')->nullable();
            $table->string('Other4_Department_person')->nullable();
            $table->string('Other4_Assessment')->nullable();
            $table->string('Other4_feedback')->nullable();
            $table->longText('Other4_attachment')->nullable();
            $table->string('Other4_by')->nullable();
            $table->date('Other4_on')->nullable();

            $table->text('Other5_review')->nullable();
            $table->text('Other5_person')->nullable();
            $table->string('Other5_Department_person')->nullable();
            $table->string('Other5_Assessment')->nullable();
            $table->string('Other5_feedback')->nullable();
            $table->longText('Other5_attachment')->nullable();
            $table->string('Other5_by')->nullable();
            $table->date('Other5_on')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deviationcfts');
    }
};
