<?php

namespace App\Repositories\Catalog\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Catalog\Product\ProductInterface;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Http\Request;
 
class ProductCache extends BaseRepository implements ProductInterface
{

    protected $product_interface;
    protected $cache_repository;

    public function __construct(
	ProductInterface $product_interface, 
	CacheRepository $cache_repository
	)
    {
        $this->product_interface = $product_interface;
        $this->cache_repository = $cache_repository;
    }
 
    public function getById($product_id, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.by.' . $product_id, env('CACHE_SECONDS'), function () use ($product_id, $relationships) {
            return $this->product_interface->getById($product_id, $relationships);
        });
    }
 
    public function getByField($fields = [], array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.field.' . frmtCacheKey(array_merge($fields,$relationships)), env('CACHE_SECONDS'), function () use ($fields, $relationships) {
            return $this->product_interface->getByField($fields, $relationships);
        });
    }
 
    public function getByFields($fields = [], array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.fields.' . frmtCacheKey(array_merge($fields,$relationships)), env('CACHE_SECONDS'), function () use ($fields, $relationships) {
            return $this->product_interface->getByFields($fields, $relationships);
        });
    }

    public function getFilter(array $fields = [], int $limit, array $relationships = [], $filter = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.filter.' . frmtCacheKey(array_merge(request()->all(), $fields, $relationships)), env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships, $filter) {
            return $this->product_interface->getFilter($fields, $limit, $relationships, $filter);
        });
    }

    public function getFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.selection.filter.' . frmtCacheKey(array_merge(request()->all(), $selection_items, $fields, $relationships)), env('CACHE_SECONDS'), function () use ($selection_items, $selection_field, $fields, $limit, $relationships, $filter) {
            return $this->product_interface->getFilterWhereIn($selection_items, $selection_field, $fields, $limit, $relationships, $filter);
        });
    }

	public function getByFieldRelation(string $relation, string $field, string $value, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.field.relation.' . $relation . $field . $value . frmtCacheKey($relationships), env('CACHE_SECONDS'), function () use ($relation, $field, $value, $relationships) {
            return $this->product_interface->getByFieldRelation($relation, $field, $value, $relationships);
        });
    }

	public function getByFieldsRelation(string $relation, string $field, string $value, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.field.relation.' . $relation . $field . $value . frmtCacheKey($relationships), env('CACHE_SECONDS'), function () use ($relation, $field, $value, $relationships) {
            return $this->product_interface->getByFieldsRelation($relation, $field, $value, $relationships);
        });
    }
 
    public function getAll(array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.all.' . frmtCacheKey(array_merge($relationships)), env('CACHE_SECONDS'), function () use ($relationships) {
            return $this->product_interface->getAll($relationships);
        });
    }

	public function getCountFilter($filter = [], array $fields = [], array $relationships = [])
	{
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.count.filter.' . frmtCacheKey(array_merge(request()->all(),$fields,$relationships)), env('CACHE_SECONDS'), function () use ($filter, $fields, $relationships) {
            return $this->product_interface->getCountFilter($filter, $fields, $relationships);
        });
	}

    public function getCountFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.selection.filter.' . frmtCacheKey(array_merge(request()->all(), $selection_items, $fields, $relationships)), env('CACHE_SECONDS'), function () use ($selection_items, $selection_field, $fields, $limit, $relationships, $filter) {
            return $this->product_interface->getCountFilterWhereIn($selection_items, $selection_field, $fields, $limit, $relationships, $filter);
        });
    }

	public function getCount(array $fields = [], array $relationships = [])
	{
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.count.' . frmtCacheKey(array_merge($fields,$relationships)), env('CACHE_SECONDS'), function () use ($fields, $relationships) {
            return $this->product_interface->getCount($fields, $relationships);
        });
	}
 
    public function getLatest(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.latest.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getLatest($fields, $limit, $relationships);
        });
    }
 
    public function getBestseller(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.bestseller.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getBestseller($fields, $limit, $relationships);
        });
    }
 
    public function getPopular(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.popular.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getPopular($fields, $limit, $relationships);
        });
    }
 
    public function getDiscount(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.discount.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getDiscount($fields, $limit, $relationships);
        });
    }
 
    public function getBrand(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.brand.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getBrand($fields, $limit, $relationships);
        });
    }
 
    public function getCategory(array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.category.' . frmtCacheKey(array_merge($fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($fields, $limit, $relationships) {
            return $this->product_interface->getCategory($fields, $limit, $relationships);
        });
    }
 
    public function getSelection(array $selection = [], array $fields = [], int $limit, array $relationships = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.selection.' . frmtCacheKey(array_merge($selection, $fields, $relationships)) . $limit, env('CACHE_SECONDS'), function () use ($selection, $fields, $limit, $relationships) {
            return $this->product_interface->getSelection($selection, $fields, $limit, $relationships);
        });
    }
 
    public function getWhereIn(array $products = [])
    {
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.where.in.' . frmtCacheKey(array_merge($products)), env('CACHE_SECONDS'), function () use ($products) {
            return $this->product_interface->getWhereIn($products);
        });
    }

	public function getByIdVariantVariable(array $variants = [], int $product_id)
	{
        return $this->cache_repository->tags(['catalog_product'])->remember('catalog_product.byId.variant.variable.' . frmtCacheKey($variants), env('CACHE_SECONDS'), function () use ($variants, $product_id) {
            return $this->product_interface->getByIdVariantVariable($variants, $product_id);
        });
	}

	public function getSortable()
	{
        return $this->product_interface->getSortable();
	}

}