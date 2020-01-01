<?php
#app/Models/ShopNewsDescription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopNewsDescription extends Model
{
    protected $primaryKey = ['lang', 'shop_news_id'];
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    public $table = 'shop_news_description';
    protected $fillable = ['lang', 'title', 'description', 'keyword', 'shop_news_id', 'content'];
}
