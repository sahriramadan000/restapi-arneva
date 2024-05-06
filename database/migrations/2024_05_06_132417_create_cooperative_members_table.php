<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperativeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperative_members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('email');
            $table->string('phone_number', 14)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 30)->nullable();
            $table->string('postal_code', 6)->nullable();
            $table->string('nik', 8)->unique();
            $table->string('employee_number', 30)->unique();
            $table->string('internal_member_number', 30)->unique();
            $table->string('member_number', 30)->unique();
            $table->date('date_of_entry')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('marital_status', 15)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('place_of_birth', 30)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('photo')->nullable();
            $table->string('relationship_with_relative', 20)->nullable();
            $table->string('relative_phone_number', 14)->nullable();
            $table->string('group', 30)->nullable();
            $table->string('mother_name', 30)->nullable();
            $table->string('status', 10)->nullable();

            $table->foreignId('education_id')->nullable()->constrained('educations');
            $table->foreignId('job_id')->nullable()->constrained('jobs');
            $table->foreignId('cooperative_id')->nullable()->constrained('cooperatives');
            $table->foreignId('religion_id')->nullable()->constrained('religions');
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
        Schema::dropIfExists('cooperative_members');
    }
}
