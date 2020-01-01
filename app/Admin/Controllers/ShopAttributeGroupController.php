<?php
#app/Http/Admin/Controllers/ShopAttributeGroupController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopAttributeGroup;
use Illuminate\Http\Request;
use Validator;

class ShopAttributeGroupController extends Controller
{

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {

        $data = [
            'title' => trans('attribute_group.admin.list'),
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
            'id' => trans('attribute_group.id'),
            'name' => trans('attribute_group.name'),
            'type' => trans('attribute_group.type'),
            'action' => trans('attribute_group.admin.action'),
        ];
        $obj = new ShopAttributeGroup;
        $obj = $obj->orderBy('id', 'desc');
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'type' => $row['type'],
                'action' => '
                    <a href="' . route('admin_attribute_group.edit', ['id' => $row['id']]) . '"><span title="' . trans('attribute_group.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('attribute_group.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('attribute_group.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('attribute_group.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_attribute_group.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('attribute_group.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

        $data['url_delete_item'] = route('admin_attribute_group.delete');

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $obj = [];
        $data = [
            'title' => trans('attribute_group.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('attribute_group.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'obj' => $obj,
            'url_action' => route('admin_attribute_group.create'),
        ];
        return view('admin.screen.attribute_group')
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
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Create new order
        $dataInsert = [
            'name' => $data['name'],
            'type' => $data['type'],
        ];
        ShopAttributeGroup::create($dataInsert);
//
        return redirect()->route('admin_attribute_group.index')->with('success', trans('attribute_group.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $obj = ShopAttributeGroup::find($id);
        if ($obj === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('attribute_group.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'obj' => $obj,
            'url_action' => route('admin_attribute_group.edit', ['id' => $obj['id']]),
        ];
        return view('admin.screen.attribute_group')
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
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit
        $dataUpdate = [
            'name' => $data['name'],
            'type' => $data['type'],
        ];
        $obj = ShopAttributeGroup::find($id);
        $obj->update($dataUpdate);
//
        return redirect()->route('admin_attribute_group.index')->with('success', trans('attribute_group.admin.edit_success'));

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
            ShopAttributeGroup::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
