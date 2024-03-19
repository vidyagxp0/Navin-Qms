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
        Schema::create('deviation_cfts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("division_id");
            $table->unsignedBigInteger("deviation_id");
            $table->string('Production_Review')->nullable();
            $table->string('Production_person')->nullable();
            $table->string('Production_assessment')->nullable();
            $table->string('Production_feedback')->nullable();
            $table->longText('production_attachment')->nullable();
            $table->date('production_on')->nullable();
            $table->string('Warehouse_review')->nullable();
            $table->string('Warehouse_person')->nullable();
            $table->string('Warehouse_assessment')->nullable();
            $table->string('Warehouse_feedback')->nullable();
            $table->text('Warehouse_attachment')->nullable();
            $table->date('Warehouse_on')->nullable();
            $table->string('QualityControl_review')->nullable();
            $table->string('QualityControl_person')->nullable();
            $table->string('QualityControl_assessment')->nullable();
            $table->string('QualityControl_feedback')->nullable();
            $table->text('QualityControl_attachment')->nullable();
            $table->date('QualityControl_on')->nullable();
            $table->string('QualityAssurance_review')->nullable();
            $table->string('QualityAssurance_person')->nullable();
            $table->string('QualityAssurance_assessment')->nullable();
            $table->string('QualityAssurance_feedback')->nullable();
            $table->text('QualityAssurance_attachment')->nullable();
            $table->date('QualityAssurance_on')->nullable();
            $table->string('Engineering_review')->nullable();
            $table->string('Engineering_person')->nullable();
            $table->string('Engineering_assessment')->nullable();
            $table->string('Engineering_feedback')->nullable();
            $table->text('Engineering_attachment')->nullable();
            $table->date('Engineering_on')->nullable();
            $table->string('Analytical_Development_review')->nullable();
            $table->string('Analytical_Development_person')->nullable();
            $table->string('Analytical_Development_assessment')->nullable();
            $table->string('Analytical_Development_feedback')->nullable();
            $table->text('Analytical_Development_attachment')->nullable();
            $table->date('Analytical_Development_on')->nullable();
            $table->string('Kilo_Lab_review')->nullable();
            $table->string('Kilo_Lab_person')->nullable();
            $table->string('Kilo_Lab_assessment')->nullable();
            $table->string('Kilo_Lab_feedback')->nullable();
            $table->text('Kilo_Lab_attachment')->nullable();
            $table->date('Kilo_Lab_on')->nullable();
            $table->string('Technology_transfer_review')->nullable();
            $table->string('Technology_transfer_person')->nullable();
            $table->string('Technology_transfer_assessment')->nullable();
            $table->string('Technology_transfer_feedback')->nullable();
            $table->text('Technology_transfer_attachment')->nullable();
            $table->date('Technology_transfer_on')->nullable();
            $table->string('Environment_Health_review')->nullable();
            $table->string('Environment_Health_person')->nullable();
            $table->string('Environment_Health_assessment')->nullable();
            $table->string('Environment_Health_feedback')->nullable();
            $table->text('Environment_Health_attachment')->nullable();
            $table->date('Environment_Health_on')->nullable();
            $table->string('Human_Resource_review')->nullable();
            $table->string('Human_Resource_person')->nullable();
            $table->string('Human_Resource_assessment')->nullable();
            $table->string('Human_Resource_feedback')->nullable();
            $table->text('Human_Resource_attachment')->nullable();
            $table->date('Human_Resource_on')->nullable();
            $table->string('Information_Technology_review')->nullable();
            $table->string('Information_Technology_person')->nullable();
            $table->string('Information_Technology_assessment')->nullable();
            $table->string('Information_Technology_feedback')->nullable();
            $table->text('Information_Technology_attachment')->nullable();
            $table->date('Information_Technology_on')->nullable();
            $table->string('Project_management_review')->nullable();
            $table->string('Project_management_person')->nullable();
            $table->string('Project_management_assessment')->nullable();
            $table->string('Project_management_feedback')->nullable();
            $table->text('Project_management_attachment')->nullable();
            $table->date('Project_management_on')->nullable();
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
        Schema::dropIfExists('deviation_cfts');

    }
};
