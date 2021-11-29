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
            $table->string("name");
            $table->string("portion_size")->nullable();
            $table->string("calories")->nullable();
            $table->string("allergies")->nullable();
            $table->string("slug");
            $table->text("description_min");
            $table->string("img");
            $table->string("banner");
            $table->string("stars");
            $table->float('price_default')->nullable();
            $table->integer('max_quantity');
            $table->integer('stock');
            $table->tinyInteger('offer')->nullable();
            $table->float('price')->default(0);
            $table->string("type")->default('menu')->nullable();
            $table->boolean("active")->default(1);
            $table->foreignId('category_id')->nullable()->index();
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
        Schema::dropIfExists('products');
    }
}