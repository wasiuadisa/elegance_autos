<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclefulldataimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclefulldataimages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('blocked')->default(0);
            $table->boolean('deleted')->default(0);
            $table->integer('vehiclefulldatas_id')->nullable();
            $table->text('caption')->nullable();
            $table->text('disk_image_filename')->nullable();
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
        Schema::dropIfExists('vehiclefulldataimages');
    }
}
