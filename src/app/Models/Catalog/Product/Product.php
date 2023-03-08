<?php

namespace App\Models\Catalog\Product;

use Illuminate\Database\Eloquent\Model;

use App\Attribute\Catalog\Product\ProductAttributes;
use App\Attribute\Catalog\Product\ProductCalculationAttributes;

use App\Models\Catalog\Product\ProductTranslation;

class Product extends Model
{

	use ProductAttributes;
	use ProductCalculationAttributes;

	protected $table = 'ctlg_product';
	protected $primaryKey = 'product_id';
	protected $fillable = [
		'code',
		'type_id',
		'variant_stock_id',
		'recurring_id',
		'condition_id',
		'adult',
		'domestic',
		'origin',
		'category_id',
		'brand_id',
		'model',
		'barcode',
		'sku',
		'upc',
		'ean',
		'jan',
		'isbn',
		'mpn',
		'oem',
		'image_cover',
		'image_hover',
		'video_cover',
		'live_broadcast_url',
		'minimum',
		'maximum',
		'coefficient',
		'unit_id',
		'stockless_id',
		'subtract',
		'buy_price',
		'buy_currency_code',
		'buy_tax_class_id',
		'sell_price',
		'sell_currency_code',
		'sell_tax_class_id',
		'sell_point',
		'discount_value',
		'discount_type',
		'special_consumption_tax',
		'special_communication_tax',
		'weight_class_id',
		'weight',
		'length_class_id',
		'length',
		'width',
		'height',
		'desi',
		'warranty_period',
		'warranty_type',
		'shipping',
		'cargo_time',
		'cargo_type',
		'cargo_price',
		'cargo_currency_code',
		'cargo_tax_class_id',
		'installment_status',
		'installment_rate',
		'point_reward',
		'viewed',
		'sort_order',
		'status_return',
		'status_membership',
		'status_usage',
		'status_publishing',
		'date_production',
		'date_expiration',
		'date_publishing_start',
		'date_publishing_end',
		'date_modified',
		'date_created',
	];
	protected $casts = [
		'buy_price' => 'double',
		'sell_price' => 'double',
		'cargo_price' => 'double',
		'discount_value' => 'double',
		'special_consumption_tax' => 'double',
		'special_communication_tax' => 'double',
	];
	protected $appends = [];
    protected $hidden = [
		'date_modified',
		'date_created',
	];
	protected $sortable = [
		'code',
		'name',
		'product_id',
		'brand_id',
		'type_id',
		'condition_id',
		'price_sell',
		'rating',
		'quantity',
		'viewed',
		'sort_order',
		'date_created',
	];
    protected static function boot()
    {
        parent::boot();
        static::retrieved(function ($product){
			
		});
    }

	const CREATED_AT = 'date_created';
	const UPDATED_AT = 'date_modified';

}