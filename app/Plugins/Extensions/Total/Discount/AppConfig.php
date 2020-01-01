<?php
#App\Plugins\Extensions\Total\Discount\AppConfig.php
namespace App\Plugins\Extensions\Total\Discount;

use App\Plugins\Extensions\Total\Discount\Models\DiscountModel;
use App\Plugins\Extensions\Total\Discount\Controllers\DiscountController;
use App\Models\AdminConfig;
use App\Plugins\Extensions\ConfigDefault;
class AppConfig extends ConfigDefault
{

    public $configKey = 'Discount';
    public $configCode = 'Total';
    public $configGroup = 'Extensions';
    public $pathPlugin;
    
    public function __construct()
    {
        $this->pathPlugin = $this->configGroup . '/' . $this->configCode . '/' . $this->configKey;
        $this->title = trans($this->pathPlugin.'::'.$this->configKey . '.title');
        $this->image = 'images/' . $this->pathPlugin . '.png';
        $this->separator = false;
        $this->suffix = false;
        $this->prefix = false;
        $this->length = 8;
        $this->mask = '****-****';
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
                    'sort' => 0,
                    'value' => self::ON, //Enable extension
                    'detail' => $this->pathPlugin.'::'.$this->configKey . '.title',
                ]
            );
            if (!$process) {
                $return = ['error' => 1, 'msg' => 'Error when install'];
            } else {
                $return = (new DiscountModel)->installExtension();
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
        (new DiscountModel)->uninstallExtension();
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
    public function config()
    {
        return redirect()->route('admin_discount.index');
    }

    public function getData()
    {
        $uID = auth()->user()->id ?? 0;
        $arrData = [
            'title' => $this->title,
            'code' => $this->configKey,
            'image' => $this->image,
            'permission' => self::ALLOW,
            'value' => 0,
            'version' => $this->version,
            'auth' => $this->auth,
            'link' => $this->link,
        ];

        $discount = session('Discount');
        $check = json_decode((new DiscountController)->check($discount, $uID), true);
        if (!empty($discount) && !$check['error']) {
            $arrType = [
                'point' => 'Point',
                'percent' => '%',
            ];
            $subtotal = \Cart::subtotal();
            $value = ($check['content']['type'] == 'percent') ? floor($subtotal * $check['content']['reward'] / 100) : $check['content']['reward'];
            $arrData = array(
                'title' => '<b>' . $this->title . ':</b> ' . $discount . '',
                'code' => $this->configKey,
                'image' => $this->image,
                'permission' => self::ALLOW,
                'value' => ($value > $subtotal) ? -$subtotal : -$value,
                'version' => $this->version,
                'auth' => $this->auth,
                'link' => $this->link,
            );
        }
        return $arrData;
    }

}
