<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Repositories\Catalog\Product\ProductCache;
use App\Repositories\Design\Page\PageCache;

use App\Http\Requests\Catalog\Product\ProductVariantStore;
use App\Http\Requests\Catalog\Product\ProductOptionStore;
use App\Http\Requests\Catalog\Product\ProductGroupedStore;

class ProductController extends CommonController
{

    protected $products;
    protected $pages;

    public function __construct(
	ProductCache $products, 
	PageCache $pages
	)
    {
        $this->products = $products;
        $this->pages = $pages;
    }

    public function detail(Request $request, $slug)
    {
		$relationships = [
			'translation', 
			'reviews', 
			'images', 
			'videos', 
			'type.translation', 
			'condition.translation', 
			'stockless.translation', 
			'unit.translation', 
			'weight_class.translation', 
			'length_class.translation',
			'brand.translation', 
			'category.translation', 
			'category.parents.translation',
			'category.parents.parents.translation',
			'category.parents.parents.parents.translation',
			'buy_currency', 
			'buy_tax_class.translation', 
			'sell_currency', 
			'sell_tax_class.translation', 
			'activitys', 
			'activitys_entered', 
			'activitys_inferred',
			'options.option.translation', 
			'options.values.value.translation', 
			'option_values.value.translation', 
			'posts.post.translation', 
			'faqs.faq.translation', 
			'fields.translation', 
			'fields.field_type.translation', 
			'attribute_variables.translation', 
			'attribute_variables.variable.translation', 
			'attribute_variables.variable.group.translation', 
			'groupeds.product.translation', 
			'groupeds.product.stockless.translation', 
			'groupeds.product.reviews', 
			'groupeds.product.images', 
			'groupeds.product.unit.translation', 
			'groupeds.product.buy_currency', 
			'groupeds.product.buy_tax_class.translation', 
			'groupeds.product.sell_currency', 
			'groupeds.product.sell_tax_class.translation', 
			'groupeds.product.activitys', 
			'groupeds.product.activitys_entered', 
			'groupeds.product.activitys_inferred', 
			'bundles.product.translation', 
			'bundles.product.stockless.translation', 
			'bundles.product.reviews', 
			'bundles.product.images', 
			'bundles.product.unit.translation', 
			'bundles.product.buy_currency', 
			'bundles.product.buy_tax_class.translation', 
			'bundles.product.sell_currency', 
			'bundles.product.sell_tax_class.translation', 
			'bundles.product.activitys', 
			'bundles.product.activitys_entered', 
			'bundles.product.activitys_inferred', 
			'relateds.product.translation', 
			'relateds.product.stockless.translation', 
			'relateds.product.reviews', 
			'relateds.product.images', 
			'relateds.product.buy_currency', 
			'relateds.product.buy_tax_class.translation', 
			'relateds.product.sell_currency', 
			'relateds.product.sell_tax_class.translation', 
			'relateds.product.activitys', 
			'relateds.product.activitys_entered', 
			'relateds.product.activitys_inferred', 
			'recurrings.recurring_type.translation', 
			'accessories.product.translation', 
			'accessories.product.stockless.translation', 
			'accessories.product.reviews', 
			'accessories.product.images', 
			'accessories.product.buy_currency', 
			'accessories.product.buy_tax_class.translation', 
			'accessories.product.sell_currency', 
			'accessories.product.sell_tax_class.translation', 
			'accessories.product.activitys', 
			'accessories.product.activitys_entered', 
			'accessories.product.activitys_inferred', 
			'variants.variant.translation', 
			'variant_stocks.variables.variable.translation', 
		];
		$product = $this->products->getByFieldRelation('translation', 'keyword', $slug, $relationships);
		$data['return_condition'] = $this->pages->getById( config('setting.accounting_restitute_contract'), ['translation']);
		$data['product'] = $product;
		$breadcrumb = array();
		$breadcrumb = setBreadcrumb($product->category, $breadcrumb, 'catalog.category.item');
		$this->setPageModule('Catalog\Product');
		$this->setPagePositions();
		$this->setPageTitle($product->translation?->name);
		$this->setPageBreadcrumb($breadcrumb);
		$this->setPageMetaTitle($product->translation?->meta_title);
		$this->setPageMetaDescription($product->translation?->meta_description);
		$this->setPageMetaKeyword($product->translation?->meta_keyword);
        return view('theme::catalog.product', $data);
    }

    public function variant(ProductVariantStore $request)
    {
		$json = false;
		$variant_stock = $this->products->getByIdVariantVariable($request->input('variants'), $request->input('product_id'));
		if(!empty($variant_stock)){
			Session::forget('variant.' . $request->input('product_id'));
			Session::put('variant.' . $request->input('product_id'), ['product_id' => $request->input('product_id'), 'variant_stock_id' => $variant_stock['product_variant_stock_id']]);
			$json = true;
		}
		if( $json == true ){
			$response = array('success' => true);
		}else{
			$response = array('error' => true);
		}
		return response()->json($response);
    }

    public function grouped(ProductGroupedStore $request)
    {
		$json = false;
		Session::put('grouped.' . $request->input('product_id') . '.' . $request->input('product_grouped_id') . '.product_id', (int)$request->input('grouped_id'));
		Session::put('grouped.' . $request->input('product_id') . '.' . $request->input('product_grouped_id') . '.quantity', (int)$request->input('grouped_quantity'));
		$json = true;
		if( $json == true ){
			$response = array('success' => true);
		}else{
			$response = array('error' => true);
		}
		return response()->json($response);
    }

    public function option(ProductOptionStore $request)
    {
		$json = false;
		$json = true;
		if( $json == true ){
			$response = array('success' => true);
		}else{
			$response = array('error' => true);
		}
		return response()->json($response);
    }

}
