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
        Schema::create('signalement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('User_id')->constrained('Users');
            $table->foreignId('point_id')->constrained('points');
            $table->string('type');
            $table->text('description');
            $table->string('statut')->default('nouveau');
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
        //
    }
};
