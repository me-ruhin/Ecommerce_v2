<?php
#App\Plugins\Modules\Cms\Content\Controllers\ContentController.php
namespace App\Plugins\Modules\Cms\Content\Controllers;

use App\Plugins\Modules\Cms\Content\Models\CmsCategory;
use App\Plugins\Modules\Cms\Content\Models\CmsContent;
use App\Http\Controllers\GeneralController;
use App\Plugins\Modules\Cms\Content\AppConfig;

class ContentController extends GeneralController
{
    public $plugin;
    public function __construct()
    {
        parent::__construct();
        $this->plugin = new AppConfig;
    }

/**
 * [news description]
 * @return [type] [description]
 */
public function category($alias)
{
    $category_currently = CmsCategory::where('alias', $alias)->first();
    $entries = (new CmsCategory)
        ->getContentsToCategory($category_currently->id, $limit = sc_config('product_new'), $opt = 'paginate');
    return view(
        $this->plugin->pathPlugin.'::cms_category',
        array(
            'title' => $category_currently['title'],
            'description' => $category_currently['description'],
            'keyword' => $category_currently['keyword'],
            'entries' => $entries,
        )
    );
}

public function content($alias)
{
    $entry_currently = CmsContent::where('alias', $alias)->first();
    if ($entry_currently) {
        $title = ($entry_currently) ? $entry_currently->title : trans('front.not_found');
        return view($this->plugin->pathPlugin.'::cms_entry_detail',
            array(
                'title' => $title,
                'entry_currently' => $entry_currently,
                'description' => $entry_currently['description'],
                'keyword' => $entry_currently['keyword'],
                'og_image' => $entry_currently->getImage(),
            )
        );
    } else {
        return view('templates.' . sc_store('template') . '.notfound',
            array(
                'title' => trans('front.not_found'),
                'description' => '',
                'keyword' => sc_store('keyword'),
                'msg' => trans('front.item_not_found'),
            )
        );
    }

}
}
