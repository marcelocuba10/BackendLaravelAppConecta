<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines_api', function (Blueprint $table) {
            $table->id();
            $table->string('worker_id');
            $table->string('worker_name');
            $table->double('shares_1m');
            $table->string('shares_5m');
            $table->string('shares_15m');
            $table->double('last_share_time');
            $table->string('last_share_ip');
            $table->string('reject_percent');
            $table->double('first_share_time');
            $table->string('miner_agent');
            $table->string('shares_unit');
            $table->string('status');
            $table->string('shares_1m_pure');
            $table->string('shares_5m_pure');
            $table->string('shares_15m_pure');
            $table->string('shares_1d');
            $table->string('shares_1d_unit');
            $table->string('reject_percent_1d');
            $table->integer('customer_id');
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
        Schema::dropIfExists('machines_api');
    }
}
