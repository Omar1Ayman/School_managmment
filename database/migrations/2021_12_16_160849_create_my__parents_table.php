<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            ///Father information
            $table->string('f_name');
            $table->string('f_id');
            $table->string("f_address");
            $table->foreignId('f_id_nationality')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreignId('f_id_religon')->references('id')->on('religons')->onDelete('cascade');
            $table->foreignId('f_id_blood')->references('id')->on('type__bloods')->onDelete('cascade');
            $table->string('f_passport');
            $table->string('f_phone');
            $table->string('f_job');
            //Mother information
            $table->string('m_name');
            $table->string('m_id');
            $table->string("m_address");
            $table->foreignId('m_id_nationality')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreignId('m_id_religon')->references('id')->on('religons')->onDelete('cascade');
            $table->foreignId('m_id_blood')->references('id')->on('type__bloods')->onDelete('cascade');
            $table->string('m_passport');
            $table->string('m_phone');
            $table->string('m_job');

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
        Schema::dropIfExists('my__parents');
    }
}
