<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcommerceUpsConfigupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icommerceups__configups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->string('access_key');
            $table->string('user_id');
            $table->string('password');
            $table->tinyInteger('mode')->default(0)->unsigned(); // 0 test - 1 live

            //$table->string('account_number')->nullable();
            
            $table->tinyInteger('weight_dimentions')->default(0)->unsigned(); // 0 LB/IN - 1 KG/CM 

            $table->string('shipper_postalcode');
            $table->string('shipper_statecode')->nullable();
            $table->string('shipper_countrycode')->nullable();

            $table->text('options')->default('')->nullable();
            $table->tinyInteger('status')->default(0)->unsigned();
            
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
        Schema::dropIfExists('icommerceups__configups');
    }
}
