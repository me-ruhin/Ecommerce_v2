<?php
#app/Http/Admin/Controllers/ExtensionsController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtensionsController extends Controller
{

    public function index($group)
    {
        $group = sc_word_format_class($group);
        $action = request('action');
        $extensionKey = request('extensionKey');
        if ($action == 'config' && $extensionKey != '') {
            $namespace = sc_get_class_extension_config($group, $extensionKey);
            $body = (new $namespace)->config();
        } else {
            $body = $this->extensionsGroup($group);
        }
        return $body;
    }

    protected function extensionsGroup($group)
    {
        $group = sc_word_format_class($group);
        $extensionsInstalled = sc_get_extension($group, $onlyActive = false);
        $extensions = sc_get_all_plugin('Extensions', $group);
        $title = trans('admin.extension_manager.' . $group);
        return $this->render($extensionsInstalled, $extensions, $title, $group);
    }

    public function render($extensionsInstalled, $extensions, $title, $group)
    {
        return view('admin.screen.extension')
            ->with(
                [
                    "title" => $title,
                    "extensionsInstalled" => $extensionsInstalled,
                    "extensions" => $extensions,
                    "group" => $group,
                ]
            )
            ->render();
    }

    public function install()
    {
        $key = request('key');
        $group = request('group');
        $group = sc_word_format_class($group);
        $namespace = sc_get_class_extension_config($group, $key);
        $response = (new $namespace)->install();
        return json_encode($response);
    }
    public function uninstall()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_extension_config($group, $key);
        $response = (new $namespace)->uninstall();
        return json_encode($response);
    }
    public function enable()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_extension_config($group, $key);
        $response = (new $namespace)->enable();
        return json_encode($response);
    }
    public function disable()
    {
        $key = request('key');
        $group = request('group');
        $namespace = sc_get_class_extension_config($group, $key);
        $response = (new $namespace)->disable();
        return json_encode($response);
    }

    public function process($group, $key)
    {
        $data = request()->all();
        $namespace = sc_get_class_extension_config($group, $key);
        $response = (new $namespace)->process($data);
        return json_encode($response);
    }
}
