<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_datas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone_number');
            $table->string('address');
            $table->string('zipcode');
            $table->string('city');
            $table->string('country')->nullable();
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('section');
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description');
            $table->uuid('category_id');
            $table->uuid('color_id');
            $table->uuid('brand_id');
            $table->decimal('discount')->nullable();
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id')->nullable();
            $table->string('image_url');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_data_id')->nullable();
            $table->string('username');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('customer_data_id')->references('id')->on('customer_datas')->nullOnDelete();
        });

        Schema::create('product_configs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('name');
            $table->decimal('price');
            $table->integer('quantity');
            $table->text('description');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_data_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('delivery_type')->nullable();
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('customer_data_id')->references('id')->on('customer_datas')->nullOnDelete();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('config_id');
            $table->uuid('product_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('config_id')->references('id')->on('product_configs')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });

        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable();
            $table->uuid('config_id');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
            $table->foreign('config_id')->references('id')->on('product_configs')->cascadeOnDelete();
        });

        Schema::create('product_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('username');
            $table->integer('rating');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('customer_datas');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_configs');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('shopping_cart_items');
        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('brands');

    }
};
