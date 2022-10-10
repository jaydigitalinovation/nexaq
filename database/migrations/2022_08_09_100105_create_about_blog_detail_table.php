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
        Schema::create('about_blog_detail', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->date('date')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('detail_description')->nullable();
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
        Schema::dropIfExists('about_blog_detail');
    }
};
