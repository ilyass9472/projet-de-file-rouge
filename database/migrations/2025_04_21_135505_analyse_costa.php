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
        Schema::create('AnalyseCosta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Signalement_id')->constrained('signalement')->unique();
            $table->float('cout_estime')->nullable();
            $table->text('rapport_dammages')->nullable();
            $table->dateTime('date_evaluation');
            $table->string('agent_responsable');
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
        Schema::dropIfExists('AnalyseCosta');
    }
};
