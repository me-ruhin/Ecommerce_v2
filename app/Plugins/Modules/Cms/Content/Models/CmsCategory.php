<?php
#app/Modules/Cms/Content/Models/CmsCategory.php
namespace App\Plugins\Modules\Cms\Content\Models;

use App\Plugins\Modules\Cms\Content\Models\CmsCategoryDescription;
use App\Plugins\Modules\Cms\Content\Models\CmsContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsCategory extends Model
{
    public $timestamps = false;
    public $table = 'cms_category';
    protected $guarded = [];
    protected $appends = [
        'title',
        'keyword',
        'description',
    ];

    public function descriptions()
    {
        return $this->hasMany(CmsCategoryDescription::class, 'category_id', 'id');
    }
    public function contents()
    {
        return $this->hasMany(CmsContent::class, 'category_id', 'id');
    }

    public function getTreeCategory($root = 0)
    {
        $list = [];
        $result = $this->select('id', 'parent')
            ->where('parent', $root)
            ->get();
        foreach ($result as $value) {
            $list[$value['id']] = $value->getTitle();
            if ($this->checkChild($value['id']) > 0) {
                $this->getTreeCategoryTmp($value['id'], $list);
            }
        }
        return $list;
    }

    public function getTreeCategoryTmp($id, &$list, $st = '--')
    {
        $result = $this->select('id', 'parent')
            ->where('parent', $id)
            ->get();
        foreach ($result as $value) {
            $list[$value['id']] = $st . ' ' . $value->getTitle();
            $this->getTreeCategoryTmp($value['id'], $list, $st . '--');
        }

    }

    public function getTreeCategories($parent = 0, &$tree = null, $categories = null, &$st = '')
    {
        $categories = $categories ?? $this->getCategoriesAll();
        $tree = $tree ?? [];
        $lisCategory = $categories[$parent] ?? [];
        foreach ($lisCategory as $category) {
            $tree[$category->id] = $st . $category->title;
            if (!empty($categories[$category->id])) {
                $st .= '--';
                $this->getTreeCategories($category->id, $tree, $categories, $st);
                $st = '';
            }
        }

        return $tree;
    }

    public function checkChild($id)
    {
        return $this->where('parent', $id)->count();
    }

    public function arrChild($id)
    {
        return $this->where('parent', $id)->pluck('id')->all();
    }

/**
 * Get category parent
 * @return [type]     [description]
 */
    public function getParent()
    {
        return $this->find($this->parent);

    }
/**
 * Get category child
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
    public function getCateChild($id)
    {
        return $this->with('contens')->where('parent', $id)->get();
    }
/**
 * Get all products in category, include child category
 * @param  [type] $id    [description]
 * @param  [type] $limit [description]
 * @return [type]        [description]
 */
    public function getContentsToCategory($id, $limit = null, $opt = null)
    {
        $arrChild = $this->arrChild($id);
        $arrChild[] = $id;
        $query = (new CmsContent)->where('status', 1)->whereIn('category_id', $arrChild)->sort();
        if (!(int) $limit) {
            return $query->get();
        } else
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else {
            return $query->limit($limit)->get();
        }

    }

    public function getCategories($parent, $limit = null, $opt = null, $sortBy = null, $sortOrder = 'asc')
    {
        $query = $this->where('status', 1)->where('parent', $parent);
        $query = $query->sort($sortBy, $sortOrder);
        if (!(int) $limit) {
            return $query->get();
        } else
        if ($opt == 'paginate') {
            return $query->paginate((int) $limit);
        } else
        if ($opt == 'random') {
            return $query->inRandomOrder()->limit($limit)->get();
        } else {
            return $query->limit($limit)->get();
        }

    }

    public function getCategoriesAll($onlyActive = false, $sortBy = null, $sortOrder = 'asc')
    {
        $listFullCategory = [];
        if (sc_config('cache_status')) {
            if (!Cache::has('all_cms_cate_' . $onlyActive . $sortBy . $sortOrder)) {

                if ($onlyActive) {
                    $listFullCategory = $this->getCategoriesActive($sortBy = null, $sortOrder = 'asc');
                } else {
                    $listFullCategory = $this->getCategoriesFull($sortBy = null, $sortOrder = 'asc');
                }
                Cache::put('all_cms_cate_' . $onlyActive . $sortBy . $sortOrder, $listFullCategory, $seconds = sc_config('cache_time', 600));
            }
            return Cache::get('all_cms_cate_' . $onlyActive . $sortBy . $sortOrder);
        } else {
            if ($onlyActive) {
                $listFullCategory = $this->getCategoriesActive($sortBy = null, $sortOrder = 'asc');
            } else {
                $listFullCategory = $this->getCategoriesFull($sortBy = null, $sortOrder = 'asc');
            }
            return $listFullCategory;
        }

    }

    public function getCategoriesActive($sortBy = null, $sortOrder = 'asc')
    {
        $lang = sc_get_locale();
        $listFullCategory = $this->with(['descriptions' => function ($q) use ($lang) {
            $q->where('lang', $lang);
        }])->where('status', 1)->sort($sortBy, $sortOrder)->get()->groupBy('parent');
        return $listFullCategory;
    }

    public function getCategoriesFull($sortBy = null, $sortOrder = 'asc')
    {
        $lang = sc_get_locale();
        $listFullCategory = $this->with(['descriptions' => function ($q) use ($lang) {
            $q->where('lang', $lang);
        }])->sort($sortBy, $sortOrder)->get()->groupBy('parent');
        return $listFullCategory;
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
        return route('cms.category', ['alias' => $this->alias]);
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

    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($category) {
            //Delete category descrition
            $category->descriptions()->delete();
        });
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
                    $table->string('image', 100)->nullable();
                    $table->tinyInteger('parent')->default(0);
                    $table->string('alias', 120)->unique();
                    $table->tinyInteger('sort')->default(0);
                    $table->tinyInteger('status')->default(0);
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
