<?php

namespace App\Models\Catalog\Product;

use Illuminate\Database\Eloquent\Model;

use App\Models\Catalog\Product\Product;

class ProductTranslation extends Model
{

	protected $table = 'ctlg_product_translation';
	protected $primaryKey = 'product_translation_id';
	protected $fillable = [
		'product_id',
		'language_code',
		'name',
		'summary',
		'description',
		'tag',
		'keyword',
		'meta_title',
		'meta_description',
		'meta_keyword',
		'date_modified',
		'date_created',
	];
	protected $hidden = [
		'product_id',
		'product_translation_id',
		'date_modified',
		'date_created',
	];

	const CREATED_AT = 'date_created';
	const UPDATED_AT = 'date_modified';

	public function product()
	{
		return $this->hasOne(Product::class, 'product_id', 'product_id');
	}

}