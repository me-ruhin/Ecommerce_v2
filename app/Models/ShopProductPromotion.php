<?php
#app/Models/ShopProductPromotion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShopProduct;
class ShopProductPromotion extends Model
{
    public $table         = 'shop_product_promotion';
    protected $guarded    = [];
    protected $primaryKey = ['product_id'];
    public $incrementing  = false;

    public function product()
    {
        return $this->belongsTo(ShopProduct::class, 'product_id', 'id');
    }

}
