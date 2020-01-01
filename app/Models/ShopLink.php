<?php
#app/Models/ShopLink.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopLink extends Model
{
    public $timestamps = false;
    public $table = 'shop_link';
    protected $guarded = [];
    protected static $getGroup = null;

    public static function getGroup()
    {
        if (!self::$getGroup) {
            self::$getGroup = self::where('status', 1)->orderBy('sort', 'desc')->orderBy('id', 'desc')->get()->groupBy('group');
        }
        return self::$getGroup;
    }
}
