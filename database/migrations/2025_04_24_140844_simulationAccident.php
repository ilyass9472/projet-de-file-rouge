<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SimulationAccident', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signalement_id')->constrained('signalement');
            $table->string('scenario_type');
            $table->float('vitesse')->nullable();
            $table->float('angle_impact')->nullable();
            $table->dateTime('date_simulation');
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
        Schema::dropIfExists('SimulationAccident');
    }
};
