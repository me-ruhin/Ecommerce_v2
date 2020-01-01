<?php
#app/Models/ShopProductCategory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductCategory extends Model
{
    protected $primaryKey = ['category_id', 'product_id'];
    public $incrementing  = false;
    protected $guarded    = [];
    public $timestamps    = false;
    public $table         = 'shop_product_category';
}
