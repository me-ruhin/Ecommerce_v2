<?php
#app/Http/Admin/Controllers/ShopBannerController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopBanner;
use Illuminate\Http\Request;
use Validator;

class ShopBannerController extends Controller
{
    protected $arrTarget;

    public function __construct()
    {
        $this->arrTarget = ['_blank' => '_blank', '_self' => '_self'];
    }

    public function index()
    {

        $data = [
            'title' => trans('banner.admin.list'),
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
            'image' => trans('banner.image'),
            'url' => trans('banner.url'),
            'sort' => trans('banner.sort'),
            'status' => trans('banner.status'),
            'click' => trans('banner.click'),
            'target' => trans('banner.target'),
            'action' => trans('banner.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('banner.admin.sort_order.id_desc'),
            'id__asc' => trans('banner.admin.sort_order.id_asc'),
        ];
        $obj = new ShopBanner;
        if ($keyword) {
            $obj = $obj->whereRaw('(email like "%' . $keyword . '%" OR name like "%' . $keyword . '%" )');
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
                'image' => sc_image_render($row->getThumb(), '', '50px'),
                'url' => $row['url'],
                'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'click' => number_format($row['click']),
                'target' => $row['target'],
                'action' => '
                    <a href="' . route('admin_banner.edit', ['id' => $row['id']]) . '"><span title="' . trans('banner.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('banner.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('banner.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('banner.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_banner.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('banner.admin.add_new') . '</span>
                           </a>
                        </div>';
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
      var url = '" . route('admin_banner.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '';
//=menu_search

        $data['url_delete_item'] = route('admin_banner.delete');

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $data = [
            'title' => trans('banner.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('banner.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'banner' => [],
            'arrTarget' => $this->arrTarget,
            'url_action' => route('admin_banner.create'),
        ];
        return view('admin.screen.banner')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'sort' => 'numeric|min:0',
            'email' => 'email|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'image' => $data['image'],
            'url' => $data['url'],
            'html' => $data['html'],
            'type' => $data['type'] ?? 0,
            'target' => $data['target'],
            'status' => empty($data['status']) ? 0 : 1,
            'sort' => (int) $data['sort'],
        ];
        ShopBanner::create($dataInsert);

        return redirect()->route('admin_banner.index')->with('success', trans('banner.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $banner = ShopBanner::find($id);
        if ($banner === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('banner.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'arrTarget' => $this->arrTarget,
            'banner' => $banner,
            'url_action' => route('admin_banner.edit', ['id' => $banner['id']]),
        ];
        return view('admin.screen.banner')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'sort' => 'numeric|min:0',
            'email' => 'email|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'image' => $data['image'],
            'url' => $data['url'],
            'html' => $data['html'],
            'type' => $data['type'] ?? 0,
            'target' => $data['target'],
            'status' => empty($data['status']) ? 0 : 1,
            'sort' => (int) $data['sort'],

        ];
        $obj = ShopBanner::find($id);
        $obj->update($dataUpdate);

//
        return redirect()->route('admin_banner.index')->with('success', trans('banner.admin.edit_success'));

    }

/*
Delete list item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            ShopBanner::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
