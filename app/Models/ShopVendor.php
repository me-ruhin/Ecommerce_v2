<?php
#app/Models/ShopVendor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopVendor extends Model
{
    public $timestamps = false;
    public $table = 'shop_vendor';
    protected $guarded = [];
    private static $getList = null;
    public static function getList()
    {
        if (self::$getList == null) {
            self::$getList = self::get()->keyBy('id');
        }
        return self::$getList;
    }

    public function products()
    {
        return $this->hasMany(ShopProduct::class, 'vendor_id', 'id');
    }

    public function getVendorsList()
    {
        return $this->orderBy('id', 'desc')->orderBy('sort', 'desc')->get();
    }

    public function getVendors($limit = null, $opt = null, $sortBy = null, $sortOrder = 'asc')
    {
        $query = $this->sort($sortBy, $sortOrder);
        if (!(int) $limit) {
            return $query->get();
        } else
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else
        if ($opt == 'random') {
            return $query->inRandomOrder()->limit($limit)->get();
        } else {
            return $query->limit($limit)->get();
        }

    }

    public function getProductsToVendor($id, $limit = null, $opt = null, $sortBy = null, $sortOrder = 'asc')
    {
        $query = (new ShopProduct)->where('status', 1)->where('vendor_id', $id);

        //Hidden product out of stock
        if (empty(sc_config('product_display_out_of_stock'))) {
            $query = $query->where('stock', '>', 0);
        }
        $query = $query->sort($sortBy, $sortOrder);
        if (!(int) $limit) {
            return $query->get();
        } else
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else
        if ($opt == 'random') {
            return $query->inRandomOrder()->limit($limit)->get();
        } else {
            return $query->limit($limit)->get();
        }

    }

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($vendor) {
        });
    }

    /**
     * [getUrl description]
     * @return [type] [description]
     */
    public function getUrl()
    {
        return route('vendor', ['alias' => $this->alias]);
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

//Scort
    public function scopeSort($query, $sortBy = null, $sortOrder = 'desc')
    {
        $sortBy = $sortBy ?? 'sort';
        return $query->orderBy($sortBy, $sortOrder);
    }
}
