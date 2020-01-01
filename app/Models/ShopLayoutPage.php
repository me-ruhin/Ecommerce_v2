<?php
#app/Models/ShopLayoutPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopLayoutPage extends Model
{
    public $timestamps = false;
    public $table = 'shop_layout_page';

    public static function getPages()
    {
        return self::pluck('name', 'key')->all();
    }
}
