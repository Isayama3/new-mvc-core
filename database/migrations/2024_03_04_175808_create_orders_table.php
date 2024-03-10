<?php

use App\Enums\OrderStatus;
use App\Models\Order;
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
        Schema::create(Order::getTableName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->enum('status', OrderStatus::casesValues())->default(OrderStatus::ORDERPLACED->value);
            $table->json('status_history')->nullable();
            $table->double('total_price')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('delivery_plan_id');
            $table->unsignedBigInteger('client_address_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('delivery_plan_id')->references('id')->on('delivery_plans')->onDelete('cascade');
            $table->foreign('client_address_id')->references('id')->on('client_addresses')->onDelete('cascade');
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
        Schema::dropIfExists(Order::getTableName());
    }
};
