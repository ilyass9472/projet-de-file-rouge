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
        Schema::create('Ntifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Signalement_id')->constrained('Signalements');
            $table->string('type');
            $table->text('contenu');
            $table->string('destinataire');
            $table->dateTime('date_envoi');
            $table->boolean('est_lue')->default(false);
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
