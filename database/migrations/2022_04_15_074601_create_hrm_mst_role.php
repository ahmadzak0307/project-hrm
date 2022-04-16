<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrmMstRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_role', function (Blueprint $table) {
            $table->integer('hrm_role_id');
            $table->integer('hrm_usr_role')->nullable();
            $table->string('hrm_role_name')->nullable();
            $table->integer('hrm_role_stat')->nullable();
            $table->datetime('hrm_role_createdAt')->nullable();
            $table->integer('hrm_role_createdBy')->nullable();
            $table->datetime('hrm_role_updatedAt')->nullable();
            $table->integer('hrm_role_updatedBy')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_mst_role');
    }
}
