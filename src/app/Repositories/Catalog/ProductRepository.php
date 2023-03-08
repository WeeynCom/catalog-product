<?php

namespace App\Repositories\Catalog\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Catalog\Product\ProductInterface;

use App\Models\Catalog\Product\Product;
use App\Models\Catalog\Product\ProductVariantVariable;

class ProductRepository extends BaseRepository implements ProductInterface
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

	public function getLatest(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('date_created', 'DESC')->paginate($limit);
	}

	public function getBestseller(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('date_created', 'DESC')->paginate($limit);
	}

	public function getPopular(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('viewed', 'DESC')->paginate($limit);
	}

	public function getDiscount(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->orWhereIn('discount_type', array('amount','percent'))->where($fields)->orderBy('date_created', 'DESC')->paginate($limit);
	}

	public function getBrand(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('viewed', 'DESC')->paginate($limit);
	}

	public function getCategory(array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('viewed', 'DESC')->paginate($limit);
	}

	public function getSelection(array $selection = [], array $fields = [], int $limit, array $relationships = [])
	{
		return $this->model->with($relationships)->where($fields)->orderBy('viewed', 'DESC')->paginate($limit);
	}

	public function getFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = [])
	{
		return $this->model->with($relationships)->where($fields)->whereIn($selection_field, $selection_items)->filter($filter)->orderBy('date_created', 'DESC')->paginate($limit);
	}

	public function getCountFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = [])
	{
		return $this->model->with($relationships)->where($fields)->whereIn($selection_field, $selection_items)->filter($filter)->count();
	}

	public function getWhereIn($products)
	{
		return $this->model->whereIn('product_id', $products)->get();
	}
	
	public function getByIdVariantVariable(array $variants = [], int $product_id)
	{
		//return $this->model->variant_variables->where('product_id' , $product_id)
		return ProductVariantVariable::where('product_id' , $product_id)
			->where(function($query) use ($variants) {
				//$query->where(function($query) use ($variants) {
					$query->whereIn('variant_variable_id', $variants);
				//});
			})
			->groupBy('product_variant_stock_id')
			->havingRaw('count(*) = 3')
			->first();
	}

	public function getSortable()
	{
		$product = new Product();
		return $product->getSortable();
	}

}
