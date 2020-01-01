<?php
#app/Http/Admin/Controllers/ShopBrandController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopBrand;
use Illuminate\Http\Request;
use Validator;

class ShopBrandController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('brand.admin.list'),
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
            'id' => trans('brand.id'),
            'name' => trans('brand.name'),
            'image' => trans('brand.image'),
            'url' => trans('brand.url'),
            'sort' => trans('brand.sort'),
            'status' => trans('brand.status'),
            'action' => trans('brand.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('brand.admin.sort_order.id_desc'),
            'id__asc' => trans('brand.admin.sort_order.id_asc'),
            'name__desc' => trans('brand.admin.sort_order.name_desc'),
            'name__asc' => trans('brand.admin.sort_order.name_asc'),
        ];
        $obj = new ShopBrand;
        if ($keyword) {
            $obj = $obj->whereRaw('(name like "%' . $keyword . '%" )');
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
                'id' => $row['id'],
                'name' => $row['name'],
                'image' => sc_image_render($row->getThumb(), '50px'),
                'url' => $row['url'],
                'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('admin_brand.edit', ['id' => $row['id']]) . '"><span title="' . trans('brand.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('brand.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('brand.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('brand.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_brand.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('brand.admin.add_new') . '</span>
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
      var url = '" . route('admin_brand.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_brand.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('brand.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_brand.delete');

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
            'title' => trans('brand.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('brand.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'brand' => [],
            'url_action' => route('admin_brand.create'),
        ];
        return view('admin.screen.brand')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();

        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_brand,alias|string|max:100',
            'image' => 'required',
            'sort' => 'numeric|min:0',
            'url' => 'url|nullable',
        ],[
            'name.required' => trans('validation.required', ['attribute' => trans('brand.name')]),
            'alias.regex' => trans('brand.alias_validate'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $dataInsert = [
            'image' => $data['image'],
            'name' => $data['name'],
            'alias' => $data['alias'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),
        ];
        ShopBrand::create($dataInsert);

        return redirect()->route('admin_brand.index')->with('success', trans('brand.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $brand = ShopBrand::find($id);
        if ($brand === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('brand.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'brand' => $brand,
            'url_action' => route('admin_brand.edit', ['id' => $brand['id']]),
        ];
        return view('admin.screen.brand')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $brand = ShopBrand::find($id);
        $data = request()->all();
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_brand,alias,' . $brand->id . ',id|string|max:100',
            'image' => 'required',
            'sort' => 'numeric|min:0',
        ], [
            'name.required' => trans('validation.required', ['attribute' => trans('brand.name')]),
            'alias.regex' => trans('brand.alias_validate'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
//Edit

        $dataUpdate = [
            'image' => $data['image'],
            'name' => $data['name'],
            'alias' => $data['alias'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),

        ];

        $brand->update($dataUpdate);

//
        return redirect()->route('admin_brand.index')->with('success', trans('brand.admin.edit_success'));

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
            ShopBrand::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
