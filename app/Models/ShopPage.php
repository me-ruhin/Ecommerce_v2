<?php
#app/Models/ShopPage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopPage extends Model
{
    public $timestamps = false;
    public $table = 'shop_page';
    protected $guarded = [];
    protected $appends = [
        'title',
        'keyword',
        'description',
        'content',
    ];

    public function descriptions()
    {
        return $this->hasMany(ShopPageDescription::class, 'page_id', 'id');
    }
    //Fields language
    public function getTitle()
    {
        return $this->processDescriptions()['title'] ?? '';
    }
    public function getKeyword()
    {
        return $this->processDescriptions()['keyword'] ?? '';
    }
    public function getDescription()
    {
        return $this->processDescriptions()['description'] ?? '';
    }
    public function getContent()
    {
        return $this->processDescriptions()['content'] ?? '';
    }

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

    public function getUrl()
    {
        return route('pages', ['name' => $this->key]);
    }

//Attributes
    public function getTitleAttribute()
    {
        return $this->getTitle();
    }
    public function getKeywordAttribute()
    {
        return $this->getKeyword();

    }
    public function getDescriptionAttribute()
    {
        return $this->getDescription();

    }

    public function getContentAttribute()
    {
        return $this->getContent();

    }
    public function processDescriptions()
    {
        return $this->descriptions->keyBy('lang')[sc_get_locale()] ?? [];
    }
}
