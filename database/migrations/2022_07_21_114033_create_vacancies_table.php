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
        Schema::create('vacancies', function (Blueprint $table) {
             $table->id();
             $table->string('position')->nullable();
             $table->Integer('job_type')->nullable();
             $table->string('experience')->nullable();
             $table->string('apply')->nullable();
             $table->text('about_role')->nullable();
             $table->text('responsibilities')->nullable();
              $table->text('requirement')->nullable();
               $table->text('skill')->nullable();
                $table->text('qualifications')->nullable();
                  $table->text('tech_experience')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
};
