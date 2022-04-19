<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmMstEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_employees', function (Blueprint $table) {
            $table->integer('id', 11);
            $table->integer('nip');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->integer('id_company');
            $table->string('gender')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('alamat')->nullable();
            $table->string('status')->nullable();
            $table->date('hrm_employees_createdAt')->nullable();
            $table->integer('hrm_employees_createdBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_mst_employees');
    }
}