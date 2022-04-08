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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categorys')->comment('User danh mục');;
            $table->string('name', 255);
            $table->string('slug')->unique()->index();
            $table->enum('status', [Product::STATUS_WAIT_ACTIVATION, Product::STATUS_ACTIVATED, Product::STATUS_DEACTIVATED])->default(Product::STATUS_WAIT_ACTIVATION);
            $table->jsonb('file_ids')->nullable()->comment('Attachment file IDs: [1, 2] (Hình ảnh sản phẩm)');
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
        Schema::dropIfExists('products');
    }
}
