<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('date');
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->double('address_latitude_in')->nullable();
            $table->double('address_longitude_in')->nullable();
            $table->double('address_latitude_out')->nullable();
            $table->double('address_longitude_out')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE reports AUTO_INCREMENT = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
