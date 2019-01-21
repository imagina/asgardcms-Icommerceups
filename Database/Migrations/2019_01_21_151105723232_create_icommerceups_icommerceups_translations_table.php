<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcommerceupsIcommerceupsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icommerceups__icommerceups_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('icommerceups_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['icommerceups_id', 'locale']);
            $table->foreign('icommerceups_id')->references('id')->on('icommerceups__icommerceups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('icommerceups__icommerceups_translations', function (Blueprint $table) {
            $table->dropForeign(['icommerceups_id']);
        });
        Schema::dropIfExists('icommerceups__icommerceups_translations');
    }
}
