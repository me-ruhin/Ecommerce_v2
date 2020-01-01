<?php
#app/Modules/Cms/Content/AppConfig.php
namespace App\Plugins\Modules\Cms\Content;

use App\Admin\Models\AdminMenu;
use App\Models\AdminConfig;
use App\Plugins\Modules\Cms\Content\Models\CmsCategory;
use App\Plugins\Modules\Cms\Content\Models\CmsCategoryDescription;
use App\Plugins\Modules\Cms\Content\Models\CmsContent;
use App\Plugins\Modules\Cms\Content\Models\CmsContentDescription;
use App\Plugins\Modules\Cms\Content\Models\CmsImage;
use App\Plugins\Modules\ConfigDefault;
class AppConfig extends ConfigDefault
{

    public $configGroup = 'Modules';
    public $configCode = 'Cms';
    public $configKey = 'Content';
    public $pathPlugin;

    public function __construct()
    {
        $this->pathPlugin = $this->configGroup . '/' . $this->configCode . '/' . $this->configKey;
        $this->title = trans($this->pathPlugin.'::'. $this->configKey . '.title_module');
        $this->image = 'images/' . $this->pathPlugin . '.png';
        $this->version = '2.1';
        $this->auth = 'Naruto';
        $this->link = 'https://s-cart.org';
    }


    public function install()
    {
        $return = ['error' => 0, 'msg' => ''];
        $check = AdminConfig::where('key', $this->configKey)->first();
        if ($check) {
            $return = ['error' => 1, 'msg' => 'Module exist'];
        } else {
            $process = AdminConfig::insert(
                [
                    'code' => $this->configCode,
                    'key' => $this->configKey,
                    'group' => $this->configGroup,
                    'value' => self::ON, //1- Enable extension; 0 - Disable
                    'detail' => $this->pathPlugin.'::'. $this->configKey . '.title',
                ]            
            );
            if (!$process) {
                $return = ['error' => 1, 'msg' => 'Error when install'];
            } else {
                $checkMenu = AdminMenu::find('100');
                if (!$checkMenu) {
                    AdminMenu::insert([
                        'id' => 100,
                        'sort' => 102,
                        'parent_id' => 7,
                        'title' => 'admin.module_manager.cms_manager',
                        'icon' => 'fa-coffee',
                    ]);
                }
                (new CmsCategory)->install();
                (new CmsCategoryDescription)->install();
                (new CmsContent)->install();
                (new CmsContentDescription)->install();
                (new CmsImage)->install();
                AdminMenu::insert(
                    [
                        'parent_id' => 100,
                        'title' => 'admin.module_manager.cms_category',
                        'icon' => 'fa-folder-open-o',
                        'uri' => 'route::admin_cms_category.index',
                    ]);
                AdminMenu::insert(
                    [
                        'parent_id' => 100,
                        'title' => 'admin.module_manager.cms_content',
                        'icon' => 'fa-copy',
                        'uri' => 'route::admin_cms_content.index',
                    ]
                );
            }
        }
        return $return;
    }

    public function uninstall()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->delete();
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error when uninstall'];
        }
        (new CmsCategory)->uninstall();
        (new CmsCategoryDescription)->uninstall();
        (new CmsContent)->uninstall();
        (new CmsContentDescription)->uninstall();
        (new CmsImage)->uninstall();
        //Remove menu
        (new AdminMenu)->where('uri', 'route::admin_cms_category.index')->delete();
        (new AdminMenu)->where('uri', 'route::admin_cms_content.index')->delete();
        if (!(new AdminMenu)->where('parent_id', 100)->count()) {
            (new AdminMenu)->find(100)->delete();
        }

        return $return;
    }

    public function enable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->update(['value' => self::ON]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error enable'];
        }
        return $return;
    }

    public function disable()
    {
        $return = ['error' => 0, 'msg' => ''];
        $process = (new AdminConfig)->where('key', $this->configKey)->update(['value' => self::OFF]);
        if (!$process) {
            $return = ['error' => 1, 'msg' => 'Error disable'];
        }
        return $return;
    }

    public function getData()
    {
        $arrData = [
            'title' => $this->title,
            'code' => $this->configKey,
            'version' => $this->version,
            'auth' => $this->auth,
            'link' => $this->link,
        ];
        return $arrData;
    }

}
