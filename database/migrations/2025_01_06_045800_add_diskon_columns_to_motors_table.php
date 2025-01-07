<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->integer('diskon_percentage')->nullable();
            $table->integer('diskon_amount')->nullable();
        });
    }

    public function down()
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropColumn(['diskon_percentage', 'diskon_amount']);
        });
    }

};
