<?php

use App\Models\Otp;
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
        Schema::create(Otp::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('otp', 4);
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->datetime('valid_until');
            $table->tinyInteger('verified')->default(0);
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
        Schema::dropIfExists(Otp::getTableName());
    }
};
