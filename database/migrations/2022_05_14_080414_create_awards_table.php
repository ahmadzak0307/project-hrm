<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrm_mst_awards', function (Blueprint $table) {
            $table->Increments('hrm_award_id');
            $table->String('hrm_company_id');
            $table->Integer('nip');
            $table->String('award_name');
            $table->String('gift');
            $table->float('case_price');
            $table->date('month');
            $table->date('year');
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
        Schema::dropIfExists('hrm_mst_awards');
    }
}
