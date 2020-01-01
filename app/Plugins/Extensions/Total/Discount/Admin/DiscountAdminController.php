<?php
#App\Plugins\Extensions\Total\Discount\Admin\DiscountAdminController.php

namespace App\Plugins\Extensions\Total\Discount\Admin;

use App\Plugins\Extensions\Total\Discount\Models\DiscountModel;
use App\Http\Controllers\Controller;
use App\Models\ShopLanguage;
use App\Plugins\Extensions\Total\Discount\AppConfig;
use Validator;

class DiscountAdminController extends Controller
{
    public $plugin;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();
        $this->plugin = new AppConfig;

    }
    public function index()
    {

        $data = [
            'title' => trans($this->plugin->pathPlugin.'::Discount.admin.list'),
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
            'id' => trans($this->plugin->pathPlugin.'::Discount.id'),
            'code' => trans($this->plugin->pathPlugin.'::Discount.code'),
            'reward' => trans($this->plugin->pathPlugin.'::Discount.reward'),
            'type' => trans($this->plugin->pathPlugin.'::Discount.type'),
            'data' => trans($this->plugin->pathPlugin.'::Discount.data'),
            'limit' => trans($this->plugin->pathPlugin.'::Discount.limit'),
            'used' => trans($this->plugin->pathPlugin.'::Discount.used'),
            'status' => trans($this->plugin->pathPlugin.'::Discount.status'),
            'login' => trans($this->plugin->pathPlugin.'::Discount.login'),
            'expires_at' => trans($this->plugin->pathPlugin.'::Discount.expires_at'),
            'action' => trans($this->plugin->pathPlugin.'::Discount.admin.action'),
        ];
        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans($this->plugin->pathPlugin.'::Discount.admin.sort_order.id_desc'),
            'id__asc' => trans($this->plugin->pathPlugin.'::Discount.admin.sort_order.id_asc'),
            'code__desc' => trans($this->plugin->pathPlugin.'::Discount.admin.sort_order.code_desc'),
            'code__asc' => trans($this->plugin->pathPlugin.'::Discount.admin.sort_order.code_asc'),
        ];
        $obj = new DiscountModel;
        if ($keyword) {
            $obj = $obj->whereRaw('code like "%' . $keyword . '%" )');
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
                'code' => $row['code'],
                'reward' => $row['reward'],
                'type' => ($row['type'] == 'point') ? 'Point' : '%',
                'data' => $row['data'],
                'limit' => $row['limit'],
                'used' => $row['used'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'login' => $row['login'],
                'expires_at' => $row['expires_at'],
                'action' => '
                    <a href="' . route('admin_discount.edit', ['id' => $row['id']]) . '"><span title="' . trans($this->plugin->pathPlugin.'::Discount.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans($this->plugin->pathPlugin.'::Discount.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans($this->plugin->pathPlugin.'::Discount.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" title="Delete"><i class="fa fa-trash-o"></i><span class="hidden-xs"> ' . trans('admin.delete') . '</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('admin.refresh') . '</span></a> &nbsp;</div>
                    ';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_discount.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans($this->plugin->pathPlugin.'::Discount.admin.add_new') . '</span>
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
      var url = '" . route('admin_discount.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_discount.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans($this->plugin->pathPlugin.'::Discount.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search
        //
        $data['url_delete_item'] = route('admin_discount.delete');

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
            'title' => trans($this->plugin->pathPlugin.'::Discount.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans($this->plugin->pathPlugin.'::Discount.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'discount' => [],
            'url_action' => route('admin_discount.create'),
        ];
        return view($this->plugin->pathPlugin.'::Discount')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'code' => 'required|regex:/(^([0-9A-Za-z\-\._]+)$)/|unique:shop_discount,code|string|max:50',
            'limit' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
            'type' => 'required',
        ], [
            'code.regex' => trans($this->plugin->pathPlugin.'::Discount.admin.code_validate'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $dataInsert = [
            'code' => $data['code'],
            'reward' => (int)$data['reward'],
            'limit' => $data['limit'],
            'type' => $data['type'],
            'data' => $data['data'],
            'login' => empty($data['login']) ? 0 : 1,
            'expires_at' => $data['expires_at'],
            'status' => empty($data['status']) ? 0 : 1,
        ];
        DiscountModel::create($dataInsert);
//
        return redirect()->route('admin_discount.index')->with('success', trans($this->plugin->pathPlugin.'::Discount.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $discount = DiscountModel::find($id);
        if ($discount === null) {
            return 'no data';
        }
        $data = [
            'title' => trans($this->plugin->pathPlugin.'::Discount.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'discount' => $discount,
            'url_action' => route('admin_discount.edit', ['id' => $discount['id']]),
        ];
        return view($this->plugin->pathPlugin.'::Discount')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $discount = DiscountModel::find($id);
        $data = request()->all();
        $validator = Validator::make($data, [
            'code' => 'required|regex:/(^([0-9A-Za-z\-\._]+)$)/|unique:shop_discount,code,' . $discount->id . ',id|string|max:50',
            'limit' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
            'type' => 'required',
        ], [
            'code.regex' => trans($this->plugin->pathPlugin.'::Discount.admin.code_validate'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit
        $dataUpdate = [
            'code' => $data['code'],
            'reward' => (int)$data['reward'],
            'limit' => $data['limit'],
            'type' => $data['type'],
            'data' => $data['data'],
            'login' => empty($data['login']) ? 0 : 1,
            'expires_at' => $data['expires_at'],
            'status' => empty($data['status']) ? 0 : 1,
        ];

        $discount->update($dataUpdate);
//
        return redirect()->route('admin_discount.index')->with('success', trans($this->plugin->pathPlugin.'::Discount.admin.edit_success'));

    }

    /*
    Delete list item
    Need mothod destroy to boot deleting in model
    */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return 0;
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            DiscountModel::destroy($arrID);
            return 1;
        }
    }

}
