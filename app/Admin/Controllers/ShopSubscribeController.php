<?php
#app/Http/Admin/Controllers/ShopSubscribeController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopSubscribe;
use Illuminate\Http\Request;
use Validator;

class ShopSubscribeController extends Controller
{

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {

        $data = [
            'title' => trans('subscribe.admin.list'),
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
            'id' => trans('subscribe.id'),
            'email' => trans('subscribe.email'),
            'status' => trans('subscribe.status'),
            'action' => trans('subscribe.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('subscribe.admin.sort_order.id_desc'),
            'id__asc' => trans('subscribe.admin.sort_order.id_asc'),
            'email__desc' => trans('subscribe.admin.sort_order.email_desc'),
            'email__asc' => trans('subscribe.admin.sort_order.email_asc'),
        ];
        $obj = new ShopSubscribe;
        if ($keyword) {
            $obj = $obj->whereRaw('(email like "%' . $keyword . '%" OR id like = "' . $keyword . '" )');
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
                'email' => $row['email'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('admin_subscribe.edit', ['id' => $row['id']]) . '"><span title="' . trans('subscribe.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('subscribe.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('subscribe.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('subscribe.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_subscribe.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('subscribe.admin.add_new') . '</span>
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
      var url = '" . route('admin_subscribe.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_subscribe.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('subscribe.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_subscribe.delete');

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
            'title' => trans('subscribe.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('subscribe.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'subscribe' => [],
            'url_action' => route('admin_subscribe.create'),
        ];
        return view('admin.screen.subscribe')
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
            'email' => 'required|email|unique:shop_subscribe,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'email' => $data['email'],
            'status' => (!empty($data['status']) ? 1 : 0),
        ];
        ShopSubscribe::create($dataInsert);

        return redirect()->route('admin_subscribe.index')->with('success', trans('subscribe.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $subscribe = ShopSubscribe::find($id);
        if ($subscribe === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('subscribe.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'subscribe' => $subscribe,
            'url_action' => route('admin_subscribe.edit', ['id' => $subscribe['id']]),
        ];
        return view('admin.screen.subscribe')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $subscribe = ShopSubscribe::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'email' => 'required|email|unique:shop_subscribe,email,' . $subscribe->id . ',id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'email' => $data['email'],
            'status' => (!empty($data['status']) ? 1 : 0),

        ];
        $obj = ShopSubscribe::find($id);
        $obj->update($dataUpdate);

//
        return redirect()->route('admin_subscribe.index')->with('success', trans('subscribe.admin.edit_success'));

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
            ShopSubscribe::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
