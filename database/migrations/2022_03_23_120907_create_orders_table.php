<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("seller_id");
            $table->integer("customer_id");
            $table->integer("amount");
            $table->string("code");
            $table->timestamps();
            $table->softDeletes();

            $table->index(["seller_id"], 'fk_orders_sellers_idx');
            $table->index(["customer_id"], 'fk_orders_customers_idx');

            $table->foreign('seller_id', 'fk_orders_sellers_idx')
                ->references('id')->on('sellers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('customer_id', 'fk_orders_customers_idx')
                ->references('id')->on('customers')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
