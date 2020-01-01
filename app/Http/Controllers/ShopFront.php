<?php
#app/Http/Controller/ShopFront.php
namespace App\Http\Controllers;

use App\Models\ShopAttributeGroup;
use App\Models\ShopBrand;
use App\Models\ShopBanner;
use App\Models\ShopCategory;
use App\Models\ShopProduct;
use App\Models\ShopVendor;
use Illuminate\Http\Request;

class ShopFront extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        return view($this->templatePath . '.shop_home',
            array(
                'products_new' => (new ShopProduct)->getProducts($type = null, $limit = sc_config('product_new'), $opt = null),
                'products_hot' => (new ShopProduct)->getProducts($type = SC_PRODUCT_HOT, $limit = sc_config('product_hot'), $opt = 'random'),
                'categories' => (new ShopCategory)->getCategoriesAll($onlyActive = true),
                'products_build' => (new ShopProduct)->getTopBuild($limit = 4),
                'products_group' => (new ShopProduct)->getTopGroup($limit = 4),
                'layout_page' => 'home',

            )
        );
    }

    /**
     * [getCategories description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getCategories(Request $request)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $itemsList = (new ShopCategory)->getCategories($parent = 0, $limit = sc_config('item_list'), $opt = 'paginate', $sortBy, $sortOrder);
        
        return view($this->templatePath . '.shop_item_list',
        array(
            'title' => trans('front.categories'),
            'itemsList' => $itemsList,
            'keyword' => '',
            'description' => '',
            'layout_page' => 'item_list',
            'filter_sort' => $filter_sort,
        ));
    }

/**
 * [productToCategory description]
 * @param  [string] $alias [description]
 * @return [type]      [description]
 */
    public function productToCategory($alias)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $category = (new ShopCategory)->getCategory($id = null, $alias);

        if ($category) {
            $products = (new ShopProduct)->getProductsToCategory($category->id, $limit = sc_config('product_list'), $opt = 'paginate', $sortBy, $sortOrder);
            $itemsList = (new ShopCategory)->getCategories($parent = $category->id);
            return view($this->templatePath . '.shop_products_list',
                array(
                    'title' => $category->name,
                    'description' => $category->description,
                    'keyword' => '',
                    'products' => $products,
                    'itemsList' => $itemsList,
                    'layout_page' => 'product_list',
                    'og_image' => url($category->getImage()),
                    'filter_sort' => $filter_sort,
                )
            );
        } else {
            return $this->itemNotFound();
        }

    }

/**
 * All products
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
    public function allProducts()
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $products = (new ShopProduct)->getProducts($type = null, $limit = sc_config('product_list'), $opt = 'paginate', $sortBy, $sortOrder);
        
        return view($this->templatePath . '.shop_products_list',
            array(
                'title' => trans('front.all_product'),
                'keyword' => '',
                'description' => '',
                'products' => $products,
                'layout_page' => 'product_list',
                'filter_sort' => $filter_sort,
            ));
    }

/**
 * [productDetail description]
 * @param  [string] $alias
 * @param  [type] $id   [description]
 * @return [type]       [description]
 */
    public function productDetail($alias)
    {
        $product = (new ShopProduct)->getProduct($id = null, $alias);
        if ($product && $product->status && (sc_config('product_display_out_of_stock') || $product->stock > 0)) {
            //Update last view
            $product->view += 1;
            $product->date_lastview = date('Y-m-d H:i:s');
            $product->save();
            //End last viewed

            //Product last view
            if (!empty(sc_config('LastViewProduct'))) {
                $arrlastView = empty(\Cookie::get('productsLastView')) ? array() : json_decode(\Cookie::get('productsLastView'), true);
                $arrlastView[$product->id] = date('Y-m-d H:i:s');
                arsort($arrlastView);
                \Cookie::queue('productsLastView', json_encode($arrlastView), (86400 * 30));
            }
            //End product last view

            $categories = $product->categories->keyBy('id')->toArray();
            $arrCategoriId = array_keys($categories);
            $productsToCategory = (new ShopProduct)->getProductsToCategory($arrCategoriId, $limit = sc_config('product_relation'), $opt = 'random');
            //Check product available
            return view($this->templatePath . '.shop_product_detail',
                array(
                    'title' => $product->name,
                    'description' => $product->description,
                    'keyword' => '',
                    'product' => $product,
                    'attributesGroup' => ShopAttributeGroup::all()->keyBy('id'),
                    'productsToCategory' => $productsToCategory,
                    'og_image' => url($product->getImage()),
                    'layout_page' => 'product_detail',
                )
            );
        } else {
            return $this->itemNotFound();
        }

    }
/**
 * Get product info
 * @param  [int] $id [description]
 * @return [json]     [description]
 */
    public function productInfo()
    {
        $id = request('id') ?? 0;
        $product = (new ShopProduct)->getProduct($id);
        $product['showPrice'] = $product->showPrice();
        $product['brand_name'] = $product->brand->name;
        $showImages = '
        <div class="carousel-inner">
        <div class="view-product item active"  data-slide-number="0">
            <img src="' . asset($product->getImage()) . '" alt="">
        </div>';

        if ($product->images->count()) {
            foreach ($product->images as $key => $image) {
                $showImages .= '<div class="view-product item"  data-slide-number="' . ($key + 1) . '">
              <img src="' . asset($image->getImage()) . '" alt="">
            </div>';
            }
        }
        $showImages .= '</div>';
        if ($product->images->count()) {
            $showImages .= '<a class="left item-control" href="#similar-product" data-slide="prev">
              <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
              <i class="fa fa-angle-right"></i>
              </a>';
        }

        $availability = '';
        if (sc_config('show_date_available') && $product->date_available >= date('Y-m-d H:i:s')) {
            $availability .= $product->date_available;
        } elseif ($product->stock <= 0 && sc_config('product_buy_out_of_stock') == 0) {
            $availability .= trans('product.out_stock');
        } else {
            $availability .= trans('product.in_stock');
        }
        $product['availability'] = $availability;
        $product['showImages'] = $showImages;
        $product['url'] = $product->getUrl();
        return response()->json($product);

    }

/**
 * [brands description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function getBrands(Request $request)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'name_desc' => ['name', 'desc'],
            'name_asc' => ['name', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $itemsList = (new ShopBrand)->getBrands($limit = sc_config('item_list'), $opt = 'paginate', $sortBy, $sortOrder);
        return view($this->templatePath . '.shop_item_list',
            array(
                'title' => trans('front.brands'),
                'itemsList' => $itemsList,
                'keyword' => '',
                'description' => '',
                'layout_page' => 'item_list',
                'filter_sort' => $filter_sort,
            ));
    }

/**
 * [productToBrand description]
 * @param  [string] $alias [description]
 * @return [type]       [description]
 */
    public function productToBrand($alias)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $brand = ShopBrand::where('alias', $alias)->first();
        if($brand) {
            return view($this->templatePath . '.shop_products_list',
                array(
                    'title' => $brand->name,
                    'description' => '',
                    'keyword' => '',
                    'layout_page' => 'product_list',
                    'products' => $brand->getProductsToBrand($brand->id, $limit = sc_config('product_list'), $opt = 'paginate', $sortBy, $sortOrder),
                    'filter_sort' => $filter_sort,
                )
            );
        } else {
            return $this->itemNotFound();
        }
    }

/**
 * [vendors description]
 * @return [type]           [description]
 */
    public function getVendors()
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'name_desc' => ['name', 'desc'],
            'name_asc' => ['name', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $itemsList = (new ShopVendor)->getVendors($limit = sc_config('item_list'), $opt = 'paginate', $sortBy, $sortOrder);

        return view($this->templatePath . '.shop_item_list',
            array(
                'title' => trans('front.vendors'),
                'itemsList' => $itemsList,
                'keyword' => '',
                'description' => '',
                'layout_page' => 'item_list',
                'filter_sort' => $filter_sort,
            ));
    }

/**
 * [productToVendor description]
 * @param  [string] alias [description]
 * @param  [type] $id   [description]
 * @return [type]       [description]
 */
    public function productToVendor($alias)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $vendor = ShopVendor::where('alias', $alias)->first();
        if ($vendor) {
            return view($this->templatePath . '.shop_products_list',
            array(
                'title' => $vendor->name,
                'description' => '',
                'keyword' => '',
                'layout_page' => 'product_list',
                'products' => $vendor->getProductsToVendor($vendor->id, $limit = sc_config('product_list'), $opt = 'paginate', $sortBy, $sortOrder),
                'filter_sort' => $filter_sort,
            )
        );
        } else {
            return $this->itemNotFound();
        }


    }

/**
 * [search description]
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function search(Request $request)
    {
        $sortBy = null;
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }
        $keyword = request('keyword') ?? '';
        return view($this->templatePath . '.shop_products_list',
            array(
                'title' => trans('front.search') . ': ' . $keyword,
                'products' => (new ShopProduct)->getSearch($keyword, $limit = sc_config('product_list'), $sortBy, $sortOrder),
                'layout_page' => 'product_list',
                'filter_sort' => $filter_sort,
            ));
    }

    /**
     * Process click banner
     *
     * @param   [int]  $id  
     *
     */
    public function clickBanner($id){
        $banner = ShopBanner::find($id);
        if($banner) {
            $banner->click +=1;
            $banner->save();
            return redirect(url($banner->url??'/'));
        }
        return redirect(url('/'));
    }

}
