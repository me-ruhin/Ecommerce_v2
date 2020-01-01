<?php
#App\Plugins\Extension\Shipping\ShippingStandard\Models\ShippingStandardModel.php
namespace App\Plugins\Extensions\Shipping\ShippingStandard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShippingStandardModel extends Model
{
    public $timestamps = false;
    public $table      = 'shipping_standard';
    protected $guarded = [];
    public function uninstallExtension()
    {
        if (Schema::hasTable($this->table)) {
            Schema::drop($this->table);
        }

    }

    public function installExtension()
    {
        $return = ['error' => 0, 'msg' => 'Install extension success'];
        if (!Schema::hasTable($this->table)) {
            try {
                Schema::create($this->table, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('fee');
                    $table->integer('shipping_free');
                });
                $this->insert(['fee' => 20000, 'shipping_free' => 100000]);
            } catch (\Exception $e) {
                $return = ['error' => 1, 'msg' => $e->getMessage()];
            }
        } else {
            $return = ['error' => 1, 'msg' => 'Table ' . $this->table . ' exist!'];
        }
        return $return;
    }
}
