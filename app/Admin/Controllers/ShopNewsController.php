<?php
#app/Http/Admin/Controllers/ShopNewsController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopLanguage;
use App\Models\ShopNews;
use App\Models\ShopNewsDescription;
use Illuminate\Http\Request;
use Validator;

class ShopNewsController extends Controller
{
    public $languages;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();

    }

    public function index()
    {
        $data = [
            'title' => trans('news.admin.list'),
            'sub_title' => '',
            'icon' => 'fa fa-indent',
            'menu_left' => '',
            'menu_right' => '',
            'menu_sort' => '',
            'script_sort' => '',
            'menu_search' => '',
            'script_search' => '',
            'listTh' => '',
            'dataTr' => '',
            'pagination' => '',
            'result_items' => '',
            'url_delete_item' => '',
        ];

        $listTh = [
            'title' => trans('news.title'),
            'image' => trans('news.image'),
            'sort' => trans('news.sort'),
            'status' => trans('news.status'),
            'action' => trans('news.admin.action'),
        ];
        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('news.admin.sort_order.id_desc'),
            'id__asc' => trans('news.admin.sort_order.id_asc'),
            'title__desc' => trans('news.admin.sort_order.title_desc'),
            'title__asc' => trans('news.admin.sort_order.title_asc'),
        ];
        $obj = new ShopNews;

        $obj = $obj
            ->leftJoin('shop_news_description', 'shop_news_description.shop_news_id', 'shop_news.id')
            ->where('shop_news_description.lang', sc_get_locale());
        if ($keyword) {
            $obj = $obj->whereRaw('(shop_news_description.title like "%' . $keyword . '%" )');
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);

        } else {
            $obj = $obj->orderBy('id', 'desc');
        }
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'title' => $row['title'],
                'image' => sc_image_render($row['image'], '50px'),
                'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('admin_news.edit', ['id' => $row['id']]) . '"><span title="' . trans('news.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                    <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>'
                ,
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('news.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
//menu_left
        $data['menu_left'] = '<div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" title="Delete"><i class="fa fa-trash-o"></i><span class="hidden-xs"> ' . trans('admin.delete') . '</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('admin.refresh') . '</span></a> &nbsp;</div>
                    ';
//=menu_left

//menu_right
        $data['menu_right'] = '
                        <div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_news.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('admin.add_new') . '</span>
                           </a>
                        </div>

                        ';
//=menu_right

//menu_sort

        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['menu_sort'] = '
                       <div class="btn-group pull-left">
                        <div class="form-group">
                           <select class="form-control" id="order_sort">
                            ' . $optionSort . '
                           </select>
                         </div>
                       </div>

                       <div class="btn-group pull-left">
                           <a class="btn btn-flat btn-primary" title="Sort" id="button_sort">
                              <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs"> ' . trans('admin.sort') . '</span>
                           </a>
                       </div>';

        $data['script_sort'] = "$('#button_sort').click(function(event) {
      var url = '" . route('admin_news.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_news.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('news.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_news.delete');

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $shopNews = [];
        $data = [
            'title' => trans('news.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('news.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'languages' => $this->languages,
            'shopNews' => $shopNews,
            'url_action' => route('admin_news.create'),

        ];

        return view('admin.screen.shop_news')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {

        $data = request()->all();

        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['title'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_news,alias|string|max:100',
            'descriptions.*.title' => 'required|string|max:100',
        ], [
            'alias.regex' => trans('news.alias_validate'),
            'descriptions.*.title.required' => trans('validation.required', ['attribute' => trans('news.title')]),
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        $dataInsert = [
            'image' => $data['image'],
            'sort' => $data['sort'],
            'alias' => $data['alias'],
            'status' => !empty($data['status']) ? 1 : 0,
        ];
        $news = ShopNews::create($dataInsert);
        $id = $news->id;
        $dataDes = [];
        $languages = $this->languages;
        foreach ($languages as $code => $value) {
            $dataDes[] = [
                'shop_news_id' => $id,
                'lang' => $code,
                'title' => $data['descriptions'][$code]['title'],
                'keyword' => $data['descriptions'][$code]['keyword'],
                'description' => $data['descriptions'][$code]['description'],
                'content' => $data['descriptions'][$code]['content'],
            ];
        }
        ShopNewsDescription::insert($dataDes);

        return redirect()->route('admin_news.index')->with('success', trans('news.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $shopNews = ShopNews::find($id);
        if ($shopNews === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('news.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'languages' => $this->languages,
            'shopNews' => $shopNews,
            'url_action' => route('admin_news.edit', ['id' => $shopNews['id']]),
        ];
        return view('admin.screen.shop_news')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $shopNews = ShopNews::find($id);
        $data = request()->all();

        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['title'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'descriptions.*.title' => 'required|string|max:100',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_news,alias,' . $shopNews->id . ',id|string|max:100',
        ], [
            'alias.regex' => trans('news.alias_validate'),
            'descriptions.*.title.required' => trans('validation.required', ['attribute' => trans('news.title')]),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
//Edit

        $dataUpdate = [
            'image' => $data['image'],
            'alias' => $data['alias'],
            'sort' => $data['sort'],
            'status' => !empty($data['status']) ? 1 : 0,
        ];

        $shopNews->update($dataUpdate);
        $shopNews->descriptions()->delete();
        $dataDes = [];
        foreach ($data['descriptions'] as $code => $row) {
            $dataDes[] = [
                'shop_news_id' => $id,
                'lang' => $code,
                'title' => $row['title'],
                'keyword' => $row['keyword'],
                'description' => $row['description'],
                'content' => $row['content'],
            ];
        }
        ShopNewsDescription::insert($dataDes);

//
        return redirect()->route('admin_news.index')->with('success', trans('news.admin.edit_success'));

    }

/*
Delete list Item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            ShopNews::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
