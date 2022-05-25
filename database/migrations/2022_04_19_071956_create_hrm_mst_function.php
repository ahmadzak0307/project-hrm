<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmMstFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_function', function (Blueprint $table) {
            $table->increments('hrm_func_id');
            $table->string('hrm_name_func')->nullable();
            $table->integer('hrm_dep_id',11);
            $table->date('hrm_func_createdAt')->nullable();
            $table->integer('hrm_func_createdBy')->nullable();
            $table->date('hrm_func_updatedAt')->nullable();
            $table->integer('hrm_func_updatedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_mst_function');
    }
}
