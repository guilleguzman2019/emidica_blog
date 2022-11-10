<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

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
            $table -> id();

            $table -> string('name');
            $table -> string('slug') -> unique();
            $table -> string('sku') -> unique();
            $table -> string('image') -> nullable();

            $table -> text('description');

            $table -> integer('price_regular');
            $table -> integer('price_sale') -> nullable();
            $table -> float('price_cost', 10, 2);
            $table -> float('price_ars', 10, 2);

            $table -> tinyInteger('variation');

            $table -> string('weight') -> nullable();
            $table -> string('size') -> nullable();

            $table -> integer('quantity') -> nullable();

            $table -> bigInteger('views') -> default(0);
            $table -> bigInteger('sales') -> default(0);

            $table -> boolean('featured') -> default(0);

            $table -> enum('status', [Product::BORRADOR, Product::PUBLICADO]) -> default(Product::BORRADOR);

            $table -> unsignedBiginteger('category_id') -> nullable();
            $table -> foreign('category_id') -> references('id') -> on('categories') -> nullOnDelete();

            $table -> unsignedBiginteger('brand_id') -> nullable();
            $table -> foreign('brand_id') -> references('id') -> on('brands') -> nullOnDelete();

            $table -> softDeletes();
            $table -> timestamps();
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
