<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclefulldatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclefulldatas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('deleted')->default(0);
            $table->boolean('blocked')->default(0);
            $table->boolean('sold')->default(0);
            $table->integer('vehicletypes_id')->nullable();
            $table->integer('vehiclebrands_id')->nullable();
            $table->string('model')->nullable();
            $table->text('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->enum('transmission', ['Automatic', 'Manual', 'Hybrid'])->default('Manual');
            $table->string('manufacture_date')->nullable();
            $table->enum('maintenance_history', ['Yes','No'])->default('No');
            $table->string('used')->default('Used');
            $table->string('price')->nullable();
            $table->enum('condition', ['Drive-off','Tow-away'])->default('Drive-off');
            $table->string('mileage')->nullable();
            $table->enum('customizations', ['Yes', 'No'])->default('No');
            $table->string('modifications')->nullable();
            $table->enum('engine_change', ['Yes', 'No'])->default('No');
            $table->enum('exterior_finish', ['Factory-paint', 'Repaint'])->default('Repaint');
            $table->string('exterior_colour')->nullable();
            $table->enum('interior_finish', ['Leather', 'Fabric'])->default('Fabric');
            $table->enum('roof', ['Covered', 'Sun-roof', 'Moon-roof', 'Convertible'])->default('Covered');
            $table->enum('accessories', ['Tool-box', 'Jack', 'Caution-signs', 'Manual'])->default('Jack');
            $table->text('tags')->nullable();
            $table->timestamps();
            $table->integer('view_count')->default(0);

            //Just in case
            $table->tinyInteger('integer_flag1')->nullable();
            $table->tinyInteger('integer_flag2')->nullable();
            $table->tinyInteger('integer_flag3')->nullable();
            $table->string('string_flag1')->nullable();
            $table->string('string_flag2')->nullable();
            $table->string('string_flag3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiclefulldatas');
    }
}
