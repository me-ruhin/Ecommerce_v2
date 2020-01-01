<?php
#app/Http/Admin/Controllers/Auth/RoleController.php
namespace App\Admin\Controllers\Auth;

use App\Admin\Admin;
use App\Admin\Models\AdminPermission;
use App\Admin\Models\AdminRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => trans('role.admin.list'),
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
            'check_row' => '',
            'id' => trans('role.id'),
            'slug' => trans('role.slug'),
            'name' => trans('role.name'),
            'permission' => trans('role.permission'),
            'created_at' => trans('role.created_at'),
            'updated_at' => trans('role.updated_at'),
            'action' => trans('role.admin.action'),
        ];
        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('role.admin.sort_order.id_desc'),
            'id__asc' => trans('role.admin.sort_order.id_asc'),
            'name__desc' => trans('role.admin.sort_order.name_desc'),
            'name__asc' => trans('role.admin.sort_order.name_asc'),
        ];
        $obj = new AdminRole;
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
            $showPermission = '';
            if ($row['permissions']->count()) {
                foreach ($row['permissions'] as $key => $p) {
                    $showPermission .= '<span class="label label-success">' . $p->name . '</span> ';
                }
            }

            $dataTr[] = [
                'check_row' => '<input type="checkbox" class="grid-row-checkbox" data-id="' . $row['id'] . '">',
                'id' => $row['id'],
                'slug' => $row['slug'],
                'name' => $row['name'],
                'permission' => $showPermission,
                'created_at' => $row['created_at'],
                'updateted_at' => $row['updateted_at'],
                'action' => (in_array($row['id'], SC_GUARD_ROLES) ? '' : '
                    <a href="' . route('admin_role.edit', ['id' => $row['id']]) . '"><span title="' . trans('role.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                    ') . ((in_array($row['id'], SC_GUARD_ROLES)) ? '' : '<span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>')
                ,
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('role.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
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
                           <a href="' . route('admin_role.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
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
      var url = '" . route('admin_role.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

        $data['url_delete_item'] = route('admin_role.delete');

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
            'title' => trans('role.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('role.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'role' => [],
            'permission' => (new AdminPermission)->pluck('name', 'id')->all(),
            'url_action' => route('admin_role.create'),

        ];

        return view('admin.auth.role')
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
            'name' => 'required|string|max:50|unique:admin_role,name',
            'slug' => 'required|regex:/(^([0-9A-Za-z\._\-]+)$)/|unique:admin_role,slug|string|max:50|min:3',
        ], [
            'slug.regex' => trans('role.slug_validate'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'name' => $data['name'],
            'slug' => $data['slug'],
        ];

        $role = AdminRole::createRole($dataInsert);
        $permission = $data['permission'] ?? [];
        //Insert permission
        if ($permission) {
            $role->permissions()->attach($permission);
        }
        return redirect()->route('admin_role.index')->with('success', trans('role.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $role = AdminRole::find($id);
        if ($role === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('role.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'role' => $role,
            'permission' => (new AdminPermission)->pluck('name', 'id')->all(),
            'url_action' => route('admin_role.edit', ['id' => $role['id']]),
        ];
        return view('admin.auth.role')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $role = AdminRole::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required|string|max:50|unique:admin_role,name,' . $role->id . '',
            'slug' => 'required|regex:/(^([0-9A-Za-z\._\-]+)$)/|unique:admin_role,slug,' . $role->id . '|string|max:50|min:3',
        ], [
            'slug.regex' => trans('role.slug_validate'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit

        $dataUpdate = [
            'name' => $data['name'],
            'slug' => $data['slug'],
        ];
        AdminRole::updateInfo($dataUpdate, $id);
        $permission = $data['permission'] ?? [];
        $role->permissions()->detach();
        //Insert permission
        if ($permission) {
            $role->permissions()->attach($permission);
        }
//
        return redirect()->route('admin_role.index')->with('success', trans('role.admin.edit_success'));

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
            $arrID = array_diff($arrID, SC_GUARD_ROLES);
            AdminRole::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
