<?php
#app/Http/Admin/Controllers/ShopVendorController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopVendor;
use Illuminate\Http\Request;
use Validator;

class ShopVendorController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('vendor.admin.list'),
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
            'id' => trans('vendor.id'),
            'name' => trans('vendor.name'),
            'image' => trans('vendor.image'),
            'email' => trans('vendor.email'),
            'phone' => trans('vendor.phone'),
            'url' => trans('vendor.url'),
            'address' => trans('vendor.address'),
            'sort' => trans('vendor.sort'),
            'action' => trans('vendor.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('vendor.admin.sort_order.id_desc'),
            'id__asc' => trans('vendor.admin.sort_order.id_asc'),
            'name__desc' => trans('vendor.admin.sort_order.name_desc'),
            'name__asc' => trans('vendor.admin.sort_order.name_asc'),
            'email__desc' => trans('vendor.admin.sort_order.email_desc'),
            'email__asc' => trans('vendor.admin.sort_order.email_asc'),
        ];
        $obj = new ShopVendor;
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
                'id' => $row['id'],
                'name' => $row['name'],
                'image' => sc_image_render($row->getThumb(), '50px', '50px'),
                'email' => $row['email'],
                'phone' => $row['phone'],
                'url' => $row['url'],
                'address' => $row['address'],
                'sort' => $row['sort'],
                'action' => '
                    <a href="' . route('admin_vendor.edit', ['id' => $row['id']]) . '"><span title="' . trans('vendor.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('vendor.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('vendor.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('vendor.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_vendor.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('vendor.admin.add_new') . '</span>
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
      var url = '" . route('admin_vendor.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_vendor.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('vendor.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_vendor.delete');

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
            'title' => trans('vendor.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('vendor.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'vendor' => [],
            'url_action' => route('admin_vendor.create'),
        ];
        return view('admin.screen.vendor')
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
            'image' => 'required',
            'sort' => 'numeric|min:0',
            'name' => 'required|string|max:100',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_vendor,alias|string|max:100',
            'url' => 'url|nullable',
            'email' => 'email|nullable',
        ],[
            'name.required' => trans('validation.required', ['attribute' => trans('vendor.name')]),
            'alias.regex' => trans('vendor.alias_validate'),
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
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'sort' => (int) $data['sort'],
        ];
        ShopVendor::create($dataInsert);

        return redirect()->route('admin_vendor.index')->with('success', trans('vendor.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $vendor = ShopVendor::find($id);
        if ($vendor === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('vendor.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'vendor' => $vendor,
            'url_action' => route('admin_vendor.edit', ['id' => $vendor['id']]),
        ];
        return view('admin.screen.vendor')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $vendor = ShopVendor::find($id);
        $data = request()->all();

        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'image' => 'required',
            'sort' => 'numeric|min:0',
            'name' => 'required|string|max:100',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_vendor,alias,' . $vendor->id . ',id|string|max:100',
            'url' => 'url|nullable',
            'email' => 'email|nullable',
        ],[
            'name.required' => trans('validation.required', ['attribute' => trans('vendor.name')]),
            'alias.regex' => trans('vendor.alias_validate'),
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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'url' => $data['url'],
            'address' => $data['address'],
            'sort' => (int) $data['sort'],

        ];
        
        $vendor->update($dataUpdate);

//
        return redirect()->route('admin_vendor.index')->with('success', trans('vendor.admin.edit_success'));

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
            ShopVendor::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
