<?php

use App\Models\ClientAddress;
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
        Schema::create(ClientAddress::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('client_name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists(ClientAddress::getTableName());
    }
};
