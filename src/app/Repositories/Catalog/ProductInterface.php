<?php

namespace App\Repositories\Catalog\Product;

interface ProductInterface
{

	public function getFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = []);

	public function getCountFilterWhereIn(array $selection_items = [], string $selection_field, array $fields = [], int $limit, array $relationships = [], $filter = []);

	public function getLatest(array $fields = [], int $limit, array $relationships = []);

	public function getBestseller(array $fields = [], int $limit, array $relationships = []);

	public function getPopular(array $fields = [], int $limit, array $relationships = []);

	public function getDiscount(array $fields = [], int $limit, array $relationships = []);

	public function getBrand(array $fields = [], int $limit, array $relationships = []);

	public function getCategory(array $fields = [], int $limit, array $relationships = []);

	public function getSelection(array $selection = [], array $fields = [], int $limit, array $relationships = []);

	public function getWhereIn(array $products);

	public function getByIdVariantVariable(array $variants = [], int $product_id);

	public function getSortable();

}