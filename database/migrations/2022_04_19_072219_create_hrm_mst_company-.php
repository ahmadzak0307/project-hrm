<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmMstCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrm_mst_company', function (Blueprint $table) {
            $table->increments('hrm_company_id');
            $table->Integer('hrm_company_code')->nullable();
            $table->String('hrm_company_name')->nullable();
            $table->Integer('hrm_company_shift')->nullable();
            $table->Integer('hrm_company_status')->nullable();
            $table->String('hrm_company_logo')->nullable();
            $table->date('hrm_company_createdAt')->nullable();
            $table->Integer('hrm_company_createdBy')->nullable();
            $table->date('hrm_company_updatedAt')->nullable();
            $table->Integer('hrm_company_updatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_mst_company');
    }
}
