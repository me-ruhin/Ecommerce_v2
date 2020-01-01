<?php
#app/Models/ShopProductImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductImage extends Model
{
    public $timestamps = false;
    public $table = 'shop_product_image';
    protected $guarded = [];

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
}
