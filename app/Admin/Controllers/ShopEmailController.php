<?php
#app/Http/Admin/Controllers/ShopEmailController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminConfig;
use Illuminate\Http\Request;

class ShopEmailController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('email.admin.list'),
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

        $obj = (new AdminConfig)->whereIn('code', ['email_action', 'smtp'])->orderBy('sort', 'asc')->get()->groupBy('code');
        $data['configs'] = $obj;
        $data['smtp_method'] = ['' => 'None Secirity', 'TLS' => 'TLS', 'SSL' => 'SSL'];

        return view('admin.screen.email_config')
            ->with($data);
    }

/*
Update value email
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

}
