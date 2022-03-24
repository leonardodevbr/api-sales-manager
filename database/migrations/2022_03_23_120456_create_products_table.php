<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer("batch_id");
            $table->string("code");
            $table->string("name");
            $table->string("color");
            $table->text("description");
            $table->integer("price");
            $table->timestamps();
            $table->softDeletes();

            $table->index(["batch_id"], 'fk_products_batches_idx');

            $table->foreign('batch_id', 'fk_products_batches_idx')
                ->references('id')->on('batches')
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
        Schema::dropIfExists('products');
    }
}
