<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpellListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spell_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('desc');
            $table->string('page', 50);
            $table->string('range', 50);
            $table->string('components', 20);
            $table->string('material', 1000)->nullable();
            $table->boolean('ritual');
            $table->string('duration', 50);
            $table->boolean('concentration');
            $table->string('casting_time', 30);
            $table->string('level', 30);
            $table->string('school', 50);
            $table->string('class', 100);
            $table->string('classification', 20);
            $table->string('higher_level', 1000)->nullable();
            $table->string('archetype', 100)->nullable();
            $table->string('domains', 50)->nullable();
            $table->string('oaths', 50)->nullable();
            $table->string('circles', 75)->nullable();
            $table->string('patrons', 100)->nullable();
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
        Schema::dropIfExists('spell_lists');
    }
}
