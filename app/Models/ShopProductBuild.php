<?php
#app/Models/ShopProductBuild.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShopProduct;

class ShopProductBuild extends Model
{
    protected $primaryKey = ['build_id', 'product_id'];
    public $incrementing  = false;
    protected $guarded    = [];
    public $timestamps    = false;
    public $table         = 'shop_product_build';
    public function product()
    {
        return $this->belongsTo(ShopProduct::class, 'product_id', 'id');
    }
}
