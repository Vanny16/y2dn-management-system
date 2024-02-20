<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrolledTable extends Migration
{
    public function up()
    {
        Schema::create('student_enrolled', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('gender');
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->date('dob');
            $table->string('department');
            $table->string('program');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_enrolled');
    }
}