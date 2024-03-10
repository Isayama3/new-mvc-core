<?php

use App\Models\Booking;
use App\Enums\BookingStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Booking::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('recipient_name');
            $table->string('car_info');
            $table->integer('postal_zip');
            $table->integer('phone_number');
            $table->string('notes')->nullable();
            $table->enum('status', BookingStatus::casesValues())->default(BookingStatus::BOOKINGPLACED->value);
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->integer('service_quantity');
            $table->double('min_price');
            $table->double('max_price');
            $table->double('total_price')->default(0);
            $table->json('status_history')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists(Booking::getTableName());
    }
};
