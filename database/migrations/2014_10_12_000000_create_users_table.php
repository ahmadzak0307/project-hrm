<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_usr', function (Blueprint $table) {
            $table->integer('hrm_usr_id', 11);
            $table->string('hrm_usr_nama')->nullable();
            $table->integer('hrm_usr_role')->nullable();
            $table->string('hrm_usr_email')->nullable();
            $table->integer('hrm_role_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('hrm_usr_token', 64)->nullable();
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
        Schema::dropIfExists('hrm_mst_usr');
    }
}
