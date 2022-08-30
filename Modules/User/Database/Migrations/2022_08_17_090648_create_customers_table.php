<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('idReference');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('access_key')->nullable();
            $table->string('puid')->nullable();
            $table->integer('total_machines');
            $table->string('pool')->nullable();
            $table->string('userIdPool')->nullable();
            $table->string('apiKey')->nullable();
            $table->string('secretKey')->nullable();

            $table->integer('workers_active')->nullable();
            $table->integer('workers_inactive')->nullable();
            $table->integer('workers_dead')->nullable();
            $table->decimal('shares_1m', 20)->nullable();
            $table->decimal('shares_5m', 20)->nullable();
            $table->decimal('shares_15m', 20)->nullable();
            $table->integer('workers_total')->nullable();
            $table->string('shares_unit')->nullable();
            $table->decimal('shares_1d', 20)->nullable();
            $table->decimal('shares_1h', 20)->nullable();

            $table->string('last10m')->nullable();
            $table->string('last30m')->nullable();
            $table->string('last1h')->nullable();
            $table->string('last1d')->nullable();
            $table->string('prev10m')->nullable();
            $table->string('prev30m')->nullable();
            $table->string('prev1h')->nullable();
            $table->string('prev1d')->nullable();
            $table->string('accepted')->nullable();
            $table->string('totalWorkers')->nullable();
            $table->string('activeWorkers')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
