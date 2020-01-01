<?php
#app/Models/ShopProductGroup.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShopProduct;

class ShopProductGroup extends Model
{
    protected $primaryKey = ['group_id', 'product_id'];
    public $incrementing  = false;
    protected $guarded    = [];
    public $timestamps    = false;
    public $table         = 'shop_product_group';

    public function product()
    {
        return $this->belongsTo(ShopProduct::class, 'product_id', 'id');
    }
}
