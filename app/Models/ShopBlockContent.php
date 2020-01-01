<?php
#app/Models/ShopBlockContent.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopBlockContent extends Model
{
    public $timestamps = false;
    public $table = 'shop_block_content';
    protected $guarded = [];
    private static $getLayout = null;

    public static function getLayout()
    {
        if (self::$getLayout == null) {
            self::$getLayout = self::where('status', 1)
                ->orderBy('sort', 'desc')
                ->get()
                ->groupBy('position');
        }
        return self::$getLayout;
    }

}
