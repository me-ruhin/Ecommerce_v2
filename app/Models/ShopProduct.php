<?php
#app/Models/ShopProduct.php
namespace App\Models;

use App\Models\ShopAttributeGroup;
use App\Models\ShopCategory;
use App\Models\ShopProductCategory;
use App\Models\ShopProductDescription;
use App\Models\ShopProductGroup;
use App\Models\ShopProductPromotion;
use DB;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    public $table = 'shop_product';
    protected $guarded = [];
    protected $appends = [
        'name',
        'keyword',
        'description',
        'content',
    ];

    protected static $listSingle = null;


/*
List product single
 */
    public static function getListSigle()
    {
        if (self::$listSingle == null) {
            self::$listSingle = self::where('kind', SC_PRODUCT_SINGLE)->get()->keyBy('id')->toArray();
        }
        return self::$listSingle;
    }
/**
 * Get top product single
 * @param  integer $limit
 * @param  string  $orderBy field
 * @param  string  $sort    asc|desc
 */
    public static function getTopSigle($limit = 8, $orderBy = 'id', $sort = 'desc')
    {
        return self::where('kind', SC_PRODUCT_SINGLE)->orderBy($orderBy, $sort)
            ->limit($limit)->get()->keyBy('id')->toArray();
    }

/**
 * Get top product build
 * @param  integer $limit
 * @param  string  $orderBy field
 * @param  string  $sort    asc|desc
 */
    public static function getTopBuild($limit = 8, $orderBy = 'id', $sort = 'desc')
    {
        return self::where('kind', SC_PRODUCT_BUILD)->orderBy($orderBy, $sort)
            ->limit($limit)->get()->keyBy('id');
    }

/**
 * Get top product group
 * @param  integer $limit
 * @param  string  $orderBy field
 * @param  string  $sort    asc|desc
 */
    public static function getTopGroup($limit = 8, $orderBy = 'id', $sort = 'desc')
    {
        return self::where('kind', SC_PRODUCT_GROUP)->orderBy($orderBy, $sort)
            ->limit($limit)->get()->keyBy('id');
    }

    public function brand()
    {
        return $this->belongsTo(ShopBrand::class, 'brand_id', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(ShopVendor::class, 'vendor_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(ShopCategory::class, ShopProductCategory::class, 'product_id', 'category_id');
    }
    public function groups()
    {
        return $this->hasMany(ShopProductGroup::class, 'group_id', 'id');
    }
    public function builds()
    {
        return $this->hasMany(ShopProductBuild::class, 'build_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ShopProductImage::class, 'product_id', 'id');
    }

    public function descriptions()
    {
        return $this->hasMany(ShopProductDescription::class, 'product_id', 'id');
    }

    public function promotionPrice()
    {
        return $this->hasOne(ShopProductPromotion::class, 'product_id', 'id');
    }
    public function attributes()
    {
        return $this->hasMany(ShopProductAttribute::class, 'product_id', 'id');
    }

/*
Get final price
 */
    public function getFinalPrice()
    {
        $promotion = $this->processPromotionPrice();
        if ($promotion != -1) {
            return $promotion;
        } else {
            return $this->price;
        }
    }

/**
 * [showPrice description]
 * @param  [type] $classNew [description]
 * @param  [type] $classOld [description]
 * @param  [type] $divWrap  [description]
 * @return [type]           [description]
 */
    public function showPrice($classNew = null, $classOld = null, $divWrap = null)
    {
        if (!sc_config('product_price')) {
            return false;
        }
        $priceFinal = $this->getFinalPrice();
        switch ($this->kind) {
            case SC_PRODUCT_GROUP:
                $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . trans('product.price_group') . '</span>';
                if ($divWrap != null) {
                    $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                }
                return $str;
                break;

            default:
                if ($this->price == $priceFinal) {
                    $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . sc_currency_render($this->price) . '</span>';
                    if ($divWrap != null) {
                        $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                    }
                    return $str;
                } else {
                    $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . sc_currency_render($priceFinal) . '</span><span class="' . (($classNew) ? $classOld : 'sc-old-price') . '">' . sc_currency_render($this->price) . '</span>';
                    if ($divWrap != null) {
                        $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                    }
                    return $str;
                }
                break;
        }

    }

    /**
     * [showPriceDetail description]
     *
     * @param   [type]  $classNew  [$classNew description]
     * @param   [type]  $classOld  [$classOld description]
     * @param   [type]  $divWrap   [$divWrap description]
     *
     * @return  [type]             [return description]
     */
    public function showPriceDetail($classNew = null, $classOld = null, $divWrap = null)
    {
        if (!sc_config('product_price')) {
            return false;
        }
        $priceFinal = $this->getFinalPrice();
        switch ($this->kind) {
            case SC_PRODUCT_GROUP:
                $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . trans('product.price_group_chose') . '</span>';
                if ($divWrap != null) {
                    $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                }
                return $str;
                break;

            default:
                if ($this->price == $priceFinal) {
                    $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . sc_currency_render($this->price) . '</span>';
                    if ($divWrap != null) {
                        $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                    }
                    return $str;
                } else {
                    $str = '<span class="' . (($classNew) ? $classNew : 'sc-new-price') . '">' . sc_currency_render($priceFinal) . '</span><span class="' . (($classNew) ? $classOld : 'sc-old-price') . '">' . sc_currency_render($this->price) . '</span>';
                    if ($divWrap != null) {
                        $str = '<div class="' . $divWrap . '">' . $str . '</div>';
                    }
                    return $str;
                }
                break;
        }

    }

/**
 * Get product detail
 * @param  [int] $id [description]
 * @param  [string] $alias [description]
 * @return [type]     [description]
 */
    public function getProduct($id = null, $alias = null)
    {
        if($id) {
            $product = $this->where('id', $id);  
        } else {
            $product = $this->where('alias', $alias);
        }
        $product = $product
            ->where('status', 1)
            ->with('images')
            ->with('promotionPrice');
        $product = $product->first();
        return $product;
    }

/**
 * [getProducts description]
 * @param  [type] $type      [description]
 * @param  [type] $limit     [description]
 * @param  [type] $opt       [description]
 * @param  [type] $sortBy    [description]
 * @param  string $sortOrder [description]
 * @return [type]            [description]
 */
    public function getProducts($type = null, $limit = null, $opt = null, $sortBy = null, $sortOrder = 'desc')
    {
        $lang = sc_get_locale();
        $query = $this->where($this->getTable() . '.status', 1)
            ->with(['descriptions' => function ($q) use ($lang) {
                $q->where('lang', $lang);
            }])
            ->with('promotionPrice');

        if ($type) {
            $query = $query->where('type', $type);
        }

        //Hidden product out of stock
        if (empty(sc_config('product_display_out_of_stock'))) {
            $query = $query->where('stock', '>', 0);
        }
        $query = $query->sort($sortBy, $sortOrder);
        //get all
        if (!(int) $limit) {
            return $query->get();
        } else
        //paginate
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else
        //random
        if ($opt == 'random') {
            return $query->inRandomOrder()->limit($limit)->get();
        } else {
            return $query->limit($limit)->get();
        }
    }

    public function getSearch($keyword, $limit = 12, $sortBy = null, $sortOrder = 'desc')
    {
        $lang = sc_get_locale();

        return $this->where('status', 1)->with(['descriptions' => function ($q) use ($lang) {
            $q->where('lang', $lang);
        }])
            ->with('promotionPrice')
            ->leftJoin((new ShopProductDescription)->getTable(), (new ShopProductDescription)->getTable() . '.product_id', $this->getTable() . '.id')
            ->where((new ShopProductDescription)->getTable() . '.lang', sc_get_locale())
            ->where(function ($sql) use ($keyword) {
                $sql->where((new ShopProductDescription)->getTable() . '.name', 'like', '%' . $keyword . '%')
                    ->orWhere($this->getTable() . '.sku', 'like', '%' . $keyword . '%');
            })
            ->sort($sortBy, $sortOrder)
            ->paginate($limit);
    }

/**
 * Get list product promotion
 * @param  [int]  $limit  [description]
 * @param  boolean $random [description]
 * @return [type]          [description]
 */
    public function getProductsSpecial($limit = null, $random = true)
    {

        $special = $this
            ->select(DB::raw($this->getTable() . '.*'))
            ->join(
                (new ShopProductPromotion)->getTable(),
                $this->getTable() . '.id', '=', (new ShopProductPromotion)->getTable() . '.product_id')
            ->where((new ShopProductPromotion)->getTable() . '.status_promotion', 1)
            ->where(function ($query) {
                $query->where((new ShopProductPromotion)->getTable() . '.date_end', '>=', date("Y-m-d"))
                    ->orWhereNull((new ShopProductPromotion)->getTable() . '.date_end');
            })
            ->where(function ($query) {
                $query->where((new ShopProductPromotion)->getTable() . '.date_start', '<=', date("Y-m-d"))
                    ->orWhereNull((new ShopProductPromotion)->getTable() . '.date_start');
            })
            ->where($this->getTable() . '.status', 1);
        if ($random) {
            $special = $special->inRandomOrder();
        }
        if ($limit) {
            $special = $special->limit($limit);
        }
        return $special->get();
    }

/*
Get products of category
category_id: array or string
 */
    public function getProductsToCategory($category_id, $limit = null, $opt = null, $sortBy = null, $sortOrder = 'asc', $status = 1)
    {
        $query = (new ShopProduct)
            ->with('promotionPrice')
            ->leftJoin((new ShopProductCategory)->getTable(), (new ShopProductCategory)->getTable() . '.product_id', $this->getTable() . '.id');
        if (is_array($category_id)) {
            $query = $query->whereIn((new ShopProductCategory)->getTable() . '.category_id', $category_id);
        } else {
            $query = $query->where((new ShopProductCategory)->getTable() . '.category_id', $category_id);
        }
        //product active
        if ($status) {
            $query = $query->where($this->getTable() . '.status', 1);
        }

        //Hidden product out of stock
        if (empty(sc_config('product_display_out_of_stock'))) {
            $query = $query->where($this->getTable() . '.stock', '>', 0);
        }
        //sort product
        $query = $query->sort($sortBy, $sortOrder);

        //Get all product
        if (!(int) $limit) {
            return $query->get();
        } else
        //paginate
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else
        //random
        if ($opt == 'random') {
            return $query->inRandomOrder()->limit($limit)->get();
        }
        //
        else {
            return $query->limit($limit)->get();
        }

    }

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($product) {
            $product->images()->delete();
            $product->descriptions()->delete();
            $product->promotionPrice()->delete();
            $product->groups()->delete();
            $product->attributes()->delete();
            $product->builds()->delete();
            $product->categories()->detach();
        });
    }

/*
Get thumb
 */
    public function getThumb()
    {
        return sc_image_get_path_thumb($this->image);
    }

/*
Get image
 */
    public function getImage()
    {
        return sc_image_get_path($this->image);

    }

/**
 * [getUrl description]
 * @return [type] [description]
 */
    public function getUrl()
    {
        return route('product.detail', ['alias' => $this->alias]);
    }

//Fields language
    public function getName()
    {
        return $this->processDescriptions()['name'] ?? '';
    }
    public function getKeyword()
    {
        return $this->processDescriptions()['keyword'] ?? '';
    }
    public function getDescription()
    {
        return $this->processDescriptions()['description'] ?? '';
    }
    public function getContent()
    {
        return $this->processDescriptions()['content'] ?? '';
    }

//Attributes
    public function getNameAttribute()
    {
        return $this->getName();
    }
    public function getKeywordAttribute()
    {
        return $this->getKeyword();

    }
    public function getDescriptionAttribute()
    {
        return $this->getDescription();

    }
    public function getContentAttribute()
    {
        return $this->getContent();

    }

/**
 * [getArrayProductName description]
 * @return [type] [description]
 */
    public static function getArrayProductName()
    {
        $products = self::select('id', 'sku')->get();
        $arrProduct = [];
        foreach ($products as $key => $product) {
            $arrProduct[$product->id] = $product->name . ' (' . $product->sku . ')';
        }
        return $arrProduct;
    }

/**
 * [getPercentDiscount description]
 * @return [type] [description]
 */
    public function getPercentDiscount()
    {
        return round((($this->price - $this->getFinalPrice()) / $this->price) * 100);
    }

    public function renderAttributeDetails()
    {
        $html = '';
        $details = $this->attributes()->get()->groupBy('attribute_group_id');
        $groups = ShopAttributeGroup::getList();
        foreach ($details as $groupId => $detailsGroup) {
            $html .= '<br><b><label>' . $groups[$groupId] . '</label></b>: ';
            foreach ($detailsGroup as $k => $detail) {
                $html .= '<label class="radio-inline"><input ' . (($k == 0) ? "checked" : "") . ' type="radio" name="form_attr[' . $groupId . ']" value="' . $detail->name . '">' . $detail->name . '</label> ';
            }
        }
        return $html;
    }

    public function renderAttributeDetailsAdmin()
    {
        $html = '';
        $details = $this->attributes()->get()->groupBy('attribute_group_id');
        $groups = ShopAttributeGroup::getList();
        foreach ($details as $groupId => $detailsGroup) {
            $html .= '<br><b><label>' . $groups[$groupId] . '</label></b>: ';
            foreach ($detailsGroup as $k => $detail) {
                $html .= '<label class="radio-inline"><input ' . (($k == 0) ? "checked" : "") . ' type="radio" name="add_att[' . $this->id . '][' . $groupId . ']" value="' . $detail->name . '">' . $detail->name . '</label> ';
            }
        }
        return $html;
    }

//Scort
    public function scopeSort($query, $sortBy = null, $sortOrder = 'desc')
    {
        $sortBy = $sortBy ?? 'id';
        return $query->orderBy($sortBy, $sortOrder);
    }

/**
//Condition:
//Active
//In of stock or allow order out of stock
//Date availabe
// Not SC_PRODUCT_GROUP
 */
    public function allowSale()
    {
        if(!sc_config('product_price')) {
            return false;
        }
        if ($this->status &&
            (sc_config('product_preorder') == 1 || $this->date_available == null || date('Y-m-d H:i:s') >= $this->date_available) &&
            (sc_config('product_buy_out_of_stock') || $this->stock) &&
            $this->kind != SC_PRODUCT_GROUP
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function processDescriptions()
    {
        return $this->descriptions->keyBy('lang')[sc_get_locale()] ?? [];
    }

/*
Check promotion price
 */
    public function processPromotionPrice()
    {
        $promotion = $this->promotionPrice;
        if ($promotion) {
            if (($promotion['date_end'] >= date("Y-m-d") || $promotion['date_end'] == null)
                && ($promotion['date_start'] <= date("Y-m-d") || $promotion['date_start'] == null)
                && $promotion['status_promotion'] = 1) {
                return $promotion['price_promotion'];
            }
        }

        return -1;
    }
    /*
    Upate stock, sold
     */
    public static function updateStock($product_id, $qty_change)
    {
        $item = ShopProduct::find($product_id);
        if ($item) {
            $item->stock = $item->stock - $qty_change;
            $item->sold = $item->sold + $qty_change;
            $item->save();

            //Process build
            $product = self::find($product_id);
            if ($product->kind == SC_PRODUCT_BUILD) {
                foreach ($product->builds as $key => $build) {
                    $productBuild = $build->product;
                    $productBuild->stock -= $qty_change * $build->quantity;
                    $productBuild->sold += $qty_change * $build->quantity;
                    $productBuild->save();
                }
            }

        }

    }
}
