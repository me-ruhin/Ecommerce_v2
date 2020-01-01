<?php
#app/Modules/Cms/Content/Models/CmsContent.php
namespace App\Plugins\Modules\Cms\Content\Models;

use App\Plugins\Modules\Cms\Content\Models\CmsCategory;
use App\Plugins\Modules\Cms\Content\Models\CmsImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsContent extends Model
{
    public $table = 'cms_content';
    protected $guarded = [];
    protected $appends = [
        'title',
        'keyword',
        'description',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(CmsCategory::class, 'category_id', 'id');
    }
    public function descriptions()
    {
        return $this->hasMany(CmsContentDescription::class, 'cms_content_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(CmsImage::class, 'content_id', 'id');
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
        return route('cms.content', ['alias' => $this->alias]);
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
//=========================

    public function uninstall()
    {
        if (Schema::hasTable($this->table)) {
            Schema::drop($this->table);
        }
    }

    public function install()
    {
        $return = ['error' => 0, 'msg' => 'Install modules success'];
        if (!Schema::hasTable($this->table)) {
            try {
                Schema::create($this->table, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('category_id')->default(0);
                    $table->string('image', 100)->nullable();
                    $table->string('alias', 120)->unique();
                    $table->tinyInteger('sort')->default(0);
                    $table->tinyInteger('status')->default(0);
                    $table->timestamp('created_at')->nullable();
                    $table->timestamp('updated_at')->nullable();
                });
            } catch (\Exception $e) {
                $return = ['error' => 1, 'msg' => $e->getMessage()];
            }
        } else {
            $return = ['error' => 1, 'msg' => 'Table ' . $this->table . ' exist!'];
        }
        return $return;
    }

    public function processDescriptions()
    {
        return $this->descriptions->keyBy('lang')[sc_get_locale()] ?? [];
    }
}
