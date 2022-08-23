<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines_history', function (Blueprint $table) {
            $table->id();
            $table->integer('machine_id');
            $table->string('name');
            $table->string('status');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->string('observation')->nullable();
            $table->string('mining_power')->nullable();
            $table->decimal('total_power', 20, 2)->nullable();
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
        Schema::dropIfExists('machines_history');
    }
}
