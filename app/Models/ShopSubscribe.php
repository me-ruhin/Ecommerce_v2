<?php
#app/Models/ShopSubscribe.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSubscribe extends Model
{
    public $table           = 'shop_subscribe';
    protected $guarded      = [];
    private static $getList = null;
    public static function getList()
    {
        if (self::$getList == null) {
            self::$getList = self::get()->keyBy('id');
        }
        return self::$getList;
    }
}
