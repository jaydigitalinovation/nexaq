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
        Schema::create('contact_detail', function (Blueprint $table) {
            $table->id();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->text('address')->nullable();


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
        Schema::dropIfExists('contact_detail');
    }
};
