<?php
#app/Http/Admin/Controllers/ModulesController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulesController extends Controller
{

    public function index($group)
    {
        $body = $this->modulesGroup($group);
        return $body;
    }

    protected function modulesGroup($group)
    {
        $group = sc_word_format_class($group);
        $modulesInstalled = sc_get_extension($group, $onlyActive = false);
        $modules = sc_get_all_plugin('Modules', $group);
        $title = trans('admin.module_manager.' . $group);
        return $this->render($modulesInstalled, $modules,  $title, $group);
    }

    public function render($modulesInstalled, $modules, $title, $group)
    {
        return view('admin.screen.module')->with(
            [
                "title" => $title,
                "modulesInstalled" => $modulesInstalled,
                "modules" => $modules,
                "group" => $group,
            ]);
    }

    public function install()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_module_config($group, $key);
        $response = (new $namespace)->install();
        return json_encode($response);
    }
    public function uninstall()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_module_config($group, $key);
        $response = (new $namespace)->uninstall();
        return json_encode($response);
    }
    public function enable()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_module_config($group, $key);
        $response = (new $namespace)->enable();
        return json_encode($response);
    }
    public function disable()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_module_config($group, $key);
        $response = (new $namespace)->disable();
        return json_encode($response);
    }
    public function process($group, $key)
    {
        $data = request()->all();
        $namespace = sc_get_class_module_config($group, $key);
        $response = (new $namespace)->processConfig($data);
        return json_encode($response);
    }
}
