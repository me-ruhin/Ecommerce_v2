<?php
#app/Http/Admin/Controllers/AdminEnvController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminConfig;
use App\Models\ShopCurrency;
use App\Models\ShopLanguage;
use Illuminate\Http\Request;

class AdminEnvController extends Controller
{

    public function index()
    {
        $languages = ShopLanguage::getArray();
        $currencies = ShopCurrency::getArray();
        $data = [
            'title' => trans('env.title'),
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

        foreach (timezone_identifiers_list() as $key => $value) {
            $timezones[$value] = $value;
        }
        $data['timezones'] = $timezones;
        $data['languages'] = $languages;
        $data['currencies'] = $currencies;
        $obj = (new AdminConfig)->where('code', 'env')->orderBy('sort', 'desc')->get();
        $data['configs'] = $obj;
//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_store_value.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('store_value.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

        return view('admin.screen.env')
            ->with($data);
    }

/*
Update value config
 */
    public function updateInfo()
    {
        $stt = 0;
        $data = request()->all();
        $name = $data['name'];
        $value = $data['value'];
        $update = AdminConfig::where('key', $name)->update(['value' => $value]);
        if ($update) {
            $stt = 1;
        }
        return response()->json(['stt' => $stt]);

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
            AdminConfig::destroy($arrID);
            return response()->json(['stt' => 1, 'msg' => '']);
        }
    }

}
