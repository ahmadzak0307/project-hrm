<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmMstDep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_dep', function (Blueprint $table) {
            $table->integer('hrm_dep_id',11);
            $table->string('hrm_name_dep')->nullable();
            $table->integer('hrm_company_id')->nullable();
            $table->date('hrm_dep_createdAt')->nullable();
            $table->integer('hrm_dep_createdBy')->nullable();
            $table->date('hrm_dep_updatedAt')->nullable();
            $table->integer('hrm_dep_updatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_mst_dep');
    }
}
