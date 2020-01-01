<?php
#app/Models/ShopOrderHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopOrderHistory extends Model
{
    public $table      = 'shop_order_history';
	const CREATED_AT = 'add_date';
	const UPDATED_AT = null;
    protected $guarded           = [];
}
