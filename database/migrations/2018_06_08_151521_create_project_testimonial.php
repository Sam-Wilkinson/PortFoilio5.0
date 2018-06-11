<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTestimonial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_testimonial', function (Blueprint $table) {
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('testimonial_id')->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('testimonial_id')->references('id')->on('testimonials');
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
        Schema::dropIfExists('project_testimonial');
    }
}
