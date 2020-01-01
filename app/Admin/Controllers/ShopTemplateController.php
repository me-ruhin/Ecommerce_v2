<?php
#app/Http/Admin/Controllers/ShopTemplateController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminConfig;
use App\Models\AdminStore;
use Illuminate\Http\Request;
use Validator;

class ShopTemplateController extends Controller
{

    public function index()
    {

        $data = [
            'title' => trans('template.admin.list'),
            'sub_title' => '',
            'more_info' => trans('template.guide'),
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

//menu_right
        $data['menu_right'] = '';
//=menu_right

        $arrTemplates = [];
        foreach (glob(resource_path() . "/views/templates/*") as $template) {
            if (is_dir($template)) {
                $infoTemlate['code'] = explode('templates/', $template)[1];
                $config = ['name' => '', 'auth' => '', 'email' => '', 'website' => ''];
                if (file_exists($template . '/config.json')) {
                    $config = json_decode(file_get_contents($template . '/config.json'), true);
                }
                $infoTemlate['config'] = $config;
                $arrTemplates[$infoTemlate['code']] = $infoTemlate;
            }
        }
        $data["templates"] = $arrTemplates;
        $data["templateCurrent"] = sc_store('template');
        return view('admin.screen.template')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $data = [
            'title' => trans('template.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('template.admin.add_new_des'),
            'icon' => 'fa fa-plus',
        ];
        return view('admin.screen.config_add')
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
            'image' => 'image | max: ' . sc_config('upload_image_size', 2048),
            'sort' => 'numeric|min:0',
            'name' => 'required|string|max:100',
            'url' => 'url|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $dataInsert = [
            'image' => $data['image'],
            'name' => $data['name'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
        ];
        $id = AdminConfig::insertGetId($dataInsert);

        return redirect()->route('admin_config.index')->with('success', trans('template.admin.create_success'));

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
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

    public function changeTemplate()
    {
        $key = request('key');
        $process = AdminStore::first()->update(['template' => $key]);
        if ($process) {
            $return = ['error' => 0, 'msg' => 'Change template success!'];
        } else {
            $return = ['error' => 1, 'msg' => 'Have an error!'];
        }
        return json_encode($return);
    }

}
