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
        Schema::create('deviation_grids', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->longText('ID_Number')->nullable();
            $table->longText('SystemName')->nullable();
            $table->longText('Instrument')->nullable();
            $table->longText('Equipment')->nullable();
            $table->longText('facility')->nullable();
            $table->longText('Number')->nullable();
            $table->longText('ReferenceDocumentName')->nullable();
            $table->longText('nameofproduct')->nullable();
            $table->string('ExpiryDate')->nullable();

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
        Schema::dropIfExists('deviation_grids');
    }
};
