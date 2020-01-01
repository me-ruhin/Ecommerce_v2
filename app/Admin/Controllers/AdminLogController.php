<?php
#app/Http/Admin/Controllers/AdminLogController.php
namespace App\Admin\Controllers;

use App\Admin\Models\AdminLog;
use App\Admin\Models\AdminUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('log.admin.list'),
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
            'id' => trans('log.id'),
            'user' => trans('log.user'),
            'method' => trans('log.method'),
            'path' => trans('log.path'),
            'ip' => trans('log.ip'),
            'user_agent' => trans('log.user_agent'),
            'input' => trans('log.input'),
            'created_at' => trans('log.created_at'),
            'action' => trans('log.admin.action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('log.admin.sort_order.id_desc'),
            'id__asc' => trans('log.admin.sort_order.id_asc'),
            'user_id__desc' => trans('log.admin.sort_order.user_id_desc'),
            'user_id__asc' => trans('log.admin.sort_order.user_id_asc'),
            'path__desc' => trans('log.admin.sort_order.path_desc'),
            'path__asc' => trans('log.admin.sort_order.path_asc'),
            'user_agent__desc' => trans('log.admin.sort_order.user_agent_desc'),
            'user_agent__asc' => trans('log.admin.sort_order.user_agent_asc'),
            'method__desc' => trans('log.admin.sort_order.method_desc'),
            'method__asc' => trans('log.admin.sort_order.method_asc'),
            'ip__desc' => trans('log.admin.sort_order.ip_desc'),
            'ip__asc' => trans('log.admin.sort_order.ip_asc'),

        ];
        $obj = new AdminLog;

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
                'check_row' => '<input type="checkbox" class="grid-row-checkbox" data-id="' . $row['id'] . '">',
                'id' => $row['id'],
                'user_id' => ($user = AdminUser::find($row['user_id'])) ? $user->name : 'N/A',
                'method' => '<span class="badge bg-' . (AdminLog::$methodColors[$row['method']] ?? '') . '">' . $row['method'] . '</span>',
                'path' => '<code>' . $row['path'] . '</code>',
                'ip' => $row['ip'],
                'user_agent' => $row['user_agent'],
                'input' => $row['input'],
                'created_at' => $row['created_at'],
                'action' => '
                  <span  onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('log.admin.delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('log.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">

                    <a class="btn   btn-flat btn-danger grid-trash" title="Delete"><i class="fa fa-trash-o"></i><span class="hidden-xs"> ' . trans('admin.delete') . '</span></a> &nbsp;

                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('log.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

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
      var url = '" . route('admin_log.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

        $data['url_delete_item'] = route('admin_log.delete');

        return view('admin.screen.list')
            ->with($data);
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
            AdminLog::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
