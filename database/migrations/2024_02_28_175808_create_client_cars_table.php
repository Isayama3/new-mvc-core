<?php

use App\Models\ClientCar;
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
        Schema::create(ClientCar::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('plate_number');
            $table->string('model');
            $table->string('plate_source');
            $table->smallInteger('year');
            $table->string('plate_code');
            $table->string('color');
            $table->string('client_name');
            $table->string('client_phone');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists(ClientCar::getTableName());
    }
};
