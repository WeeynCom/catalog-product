<?php

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
	
        Schema::create('ctlg_product', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
            $table->bigIncrements('product_id');
			$table->string('code', 255);
			$table->integer('type_id')->default(0);
			$table->integer('variant_stock_id')->default(0);
			$table->integer('recurring_id')->default(0);
			$table->integer('condition_id')->default(0);
			$table->tinyInteger('adult')->default(0);
			$table->tinyInteger('domestic')->default(0);
			$table->string('origin', 255)->nullable();
			$table->integer('category_id')->default(0);
			$table->integer('brand_id')->default(0);
			$table->string('model', 255);
			$table->string('barcode', 255);
			$table->string('sku', 255);
			$table->string('upc', 255)->nullable();
			$table->string('ean', 255)->nullable();
			$table->string('jan', 255)->nullable();
			$table->string('isbn', 255)->nullable();
			$table->string('mpn', 255)->nullable();
			$table->string('oem', 255)->nullable();
			$table->string('image_cover', 255);
			$table->string('image_hover', 255);
			$table->string('video_cover', 255);
			$table->string('live_broadcast_url', 255);
			$table->integer('minimum')->default(0);
			$table->integer('maximum')->default(0);
			$table->integer('coefficient')->default(0);
			$table->integer('unit_id')->default(0);
			$table->integer('stockless_id')->default(0);
			$table->integer('subtract')->default(0);
			$table->decimal('buy_price', 19, 2);
			$table->string('buy_currency_code', 255);
			$table->integer('buy_tax_class_id')->default(0);
			$table->decimal('sell_price', 19, 2);
			$table->string('sell_currency_code', 255);
			$table->integer('sell_tax_class_id')->default(0);
			$table->integer('sell_point')->default(0);
			$table->decimal('discount_value', 19, 2);
			$table->string('discount_type', 255);
			$table->decimal('special_consumption_tax', 19, 2)->nullable();
			$table->decimal('special_communication_tax', 19, 2)->nullable();
			$table->integer('weight_class_id')->default(0);
			$table->integer('weight')->default(0);
			$table->integer('length_class_id')->default(0);
			$table->integer('length')->default(0);
			$table->integer('width')->default(0);
			$table->integer('height')->default(0);
			$table->string('desi', 255)->nullable();
			$table->integer('warranty_period')->default(0);
			$table->enum('warranty_type', ['day', 'week', 'month', 'year'])->nullable();
			$table->integer('shipping')->default(0);
			$table->integer('delivery_time')->default(0);
			$table->enum('delivery_type', ['day', 'week', 'month', 'year'])->nullable();
			$table->integer('cargo_time')->default(0);
            $table->enum('cargo_type', ['day', 'week', 'month', 'year'])->nullable();
			$table->decimal('cargo_price', 19, 2)->nullable();
			$table->string('cargo_currency_code', 255)->nullable();
			$table->integer('cargo_tax_class_id')->default(0);
			$table->tinyInteger('installment_status')->default(0);
			$table->integer('installment_rate')->default(0);
			$table->integer('point_reward')->default(0);
			$table->integer('viewed')->default(0);
			$table->integer('layout_id')->default(0);
			$table->integer('sort_order')->default(0);
			$table->tinyInteger('status_return')->default(0);
			$table->tinyInteger('status_membership')->default(0);
			$table->tinyInteger('status_usage')->default(0);
			$table->tinyInteger('status_publishing')->default(0);
			$table->timestamp('date_production', 0)->nullable();
			$table->timestamp('date_expiration', 0)->nullable();
			$table->timestamp('date_publishing_start', 0)->nullable();
			$table->timestamp('date_publishing_end', 0)->nullable();
			$table->timestamp('date_modified', 0);
			$table->timestamp('date_created', 0);
        });
		
        Schema::create('ctlg_product_translation', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
            $table->bigIncrements('product_translation_id');
			$table->index('product_id');
			$table->integer('product_id')->default(0);
			$table->string('language_code', 255);
			$table->string('name', 255);
			$table->string('summary', 255);
			$table->text('description');
			$table->string('tag', 255);
			$table->string('keyword', 255);
			$table->string('meta_title', 255);
			$table->string('meta_description', 255);
			$table->string('meta_keyword', 255);
			$table->timestamp('date_modified', 0);
			$table->timestamp('date_created', 0);
        });
	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctlg_product');
        Schema::dropIfExists('ctlg_product_translation');
    }

};
