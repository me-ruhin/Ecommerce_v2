<?php
#app/Http/Admin/Controllers/Auth/PermissionController.php
namespace App\Admin\Controllers\Auth;

use App\Admin\Admin;
use App\Admin\Models\AdminPermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class PermissionController extends Controller
{

    public $routeAdmin;

    public function __construct()
    {
        $routes = app()->routes->getRoutes();
        foreach ($routes as $value) {
            if (\Illuminate\Support\Str::startsWith($value->getPrefix(), config('app.admin_prefix'))) {
                $routeAdmin[$value->getPrefix()] = [
                    'uri' => 'ANY::' . $value->getPrefix() . '/*',
                    'name' => $value->getPrefix() . '/*',
                    'method' => 'ANY',
                ];
                foreach ($value->methods as $key => $method) {
                    if ($method != 'HEAD' && !collect($this->without())->first(function ($exp) use ($value) {
                        return Str::startsWith($value->uri, $exp);
                    })) {
                        $routeAdmin[] = [
                            'uri' => $method . '::' . $value->uri,
                            'name' => $value->getName(),
                            'method' => $method,
                        ];
                    }

                }
            }
        }
        $this->routeAdmin = $routeAdmin;
    }

    public function index()
    {
        $data = [
            'title' => trans('permission.admin.list'),
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
            'id' => trans('permission.id'),
            'slug' => trans('permission.slug'),
            'name' => trans('permission.name'),
            'http_path' => trans('permission.http_path'),
            'updated_at' => trans('permission.updated_at'),
            'action' => trans('permission.admin.action'),
        ];
        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('permission.admin.sort_order.id_desc'),
            'id__asc' => trans('permission.admin.sort_order.id_asc'),
            'name__desc' => trans('permission.admin.sort_order.name_desc'),
            'name__asc' => trans('permission.admin.sort_order.name_asc'),
        ];
        $obj = new AdminPermission;
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
            $permissions = '';
            if ($row['http_uri']) {
                $methods = array_map(function ($value) {
                    $route = explode('::', $value);
                    $methodStyle = '';
                    if ($route[0] == 'ANY') {
                        $methodStyle = '<span class="label label-info">' . $route[0] . '</span>';
                    } else
                    if ($route[0] == 'POST') {
                        $methodStyle = '<span class="label label-warning">' . $route[0] . '</span>';
                    } else {
                        $methodStyle = '<span class="label label-primary">' . $route[0] . '</span>';
                    }
                    return $methodStyle . ' <code>' . $route[1] . '</code>';
                }, explode(',', $row['http_uri']));
                $permissions = implode('<br>', $methods);
            }
            $dataTr[] = [
                'check_row' => '<input type="checkbox" class="grid-row-checkbox" data-id="' . $row['id'] . '">',
                'id' => $row['id'],
                'slug' => $row['slug'],
                'name' => $row['name'],
                'permission' => $permissions,
                'updated_at' => $row['updated_at'],
                'action' => '
                    <a href="' . route('admin_permission.edit', ['id' => $row['id']]) . '"><span title="' . trans('permission.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
                    <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>'
                ,
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('permission.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
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
                           <a href="' . route('admin_permission.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
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
      var url = '" . route('admin_permission.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

        $data['url_delete_item'] = route('admin_permission.delete');

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
            'title' => trans('permission.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('permission.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'permission' => [],
            'routeAdmin' => $this->routeAdmin,
            'url_action' => route('admin_permission.create'),

        ];

        return view('admin.auth.permission')
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
            'name' => 'required|string|max:50|unique:admin_permission,name',
            'slug' => 'required|regex:/(^([0-9A-Za-z\._\-]+)$)/|unique:admin_permission,slug|string|max:50|min:3',
        ], [
            'slug.regex' => trans('permission.slug_validate'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dataInsert = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'http_uri' => implode(',', ($data['http_uri'] ?? [])),
        ];

        $permission = AdminPermission::createPermission($dataInsert);

        return redirect()->route('admin_permission.index')->with('success', trans('permission.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $permission = AdminPermission::find($id);
        if ($permission === null) {
            return 'no data';
        }
        $data = [
            'title' => trans('permission.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'permission' => $permission,
            'routeAdmin' => $this->routeAdmin,
            'url_action' => route('admin_permission.edit', ['id' => $permission['id']]),
        ];
        return view('admin.auth.permission')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $permission = AdminPermission::find($id);
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required|string|max:50|unique:admin_permission,name,' . $permission->id . '',
            'slug' => 'required|regex:/(^([0-9A-Za-z\._\-]+)$)/|unique:admin_permission,slug,' . $permission->id . '|string|max:50|min:3',
        ], [
            'slug.regex' => trans('permission.slug_validate'),
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
            'http_uri' => implode(',', ($data['http_uri'] ?? [])),
        ];
        AdminPermission::updateInfo($dataUpdate, $id);
//
        return redirect()->route('admin_permission.index')->with('success', trans('permission.admin.edit_success'));

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
            AdminPermission::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

    public function without()
    {
        return [
            config('app.admin_prefix') . '/login',
            config('app.admin_prefix') . '/logout',
            config('app.admin_prefix') . '/forgot',
            config('app.admin_prefix') . '/deny',
            config('app.admin_prefix') . '/locale',
            config('app.admin_prefix') . '/uploads',
        ];
    }

}
