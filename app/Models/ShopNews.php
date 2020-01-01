<?php
#app/Models/ShopNews.php
namespace App\Models;

use App\Models\ShopNewsDescription;
use Illuminate\Database\Eloquent\Model;

class ShopNews extends Model
{
    public $table = 'shop_news';
    protected $guarded = [];
    protected $appends = [
        'title',
        'keyword',
        'description',
        'content',
    ];

    public function descriptions()
    {
        return $this->hasMany(ShopNewsDescription::class, 'shop_news_id', 'id');
    }
    public function getItemsNews($limit = null, $opt = null)
    {
        $query = (new ShopNews)->where('status', 1)->sort();
        if (!(int) $limit) {
            return $query->get();
        } else
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else {
            return $query->limit($limit)->get();
        }

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
/**
 * [getUrl description]
 * @return [type] [description]
 */
    public function getUrl()
    {
        return route('news.detail', ['alias' => $this->alias]);
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
//Scort
    public function scopeSort($query, $column = null)
    {
        $column = $column ?? 'sort';
        return $query->orderBy($column, 'asc')->orderBy('id', 'desc');
    }

    public function processDescriptions()
    {
        return $this->descriptions->keyBy('lang')[sc_get_locale()] ?? [];
    }

}
