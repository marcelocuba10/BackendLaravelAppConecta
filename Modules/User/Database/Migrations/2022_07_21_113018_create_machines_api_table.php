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
            $table->string('worker')->nullable();
            $table->string('last10m')->nullable();
            $table->string('last30m')->nullable();
            $table->string('last1h')->nullable();
            $table->string('last1d')->nullable();
            $table->string('prev10m')->nullable();
            $table->string('prev30m')->nullable();
            $table->string('prev1h')->nullable();
            $table->string('prev1d')->nullable();
            $table->string('worker_id')->nullable();
            $table->string('worker_name')->nullable();
            $table->double('shares_1m')->nullable();
            $table->string('shares_5m')->nullable();
            $table->string('shares_15m')->nullable();
            $table->string('shares_1h')->nullable();
            $table->string('shares_1d')->nullable();
            $table->double('last_share_time')->nullable();
            $table->string('last_share_ip')->nullable();
            $table->string('reject_percent')->nullable();
            $table->double('first_share_time')->nullable();
            $table->string('miner_agent')->nullable();
            $table->string('shares_unit')->nullable();
            $table->string('status')->nullable();
            $table->string('shares_1m_pure')->nullable();
            $table->string('shares_5m_pure')->nullable();
            $table->string('shares_15m_pure')->nullable();
            $table->string('shares_1d_unit')->nullable();
            $table->string('reject_percent_1d')->nullable();
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
