<?php
#App\Plugins\Extension\Payment\Cash\Controllers\CashController.php
namespace App\Plugins\Extensions\Payment\Cash\Controllers;

use App\Http\Controllers\ShopCart;
use App\Http\Controllers\GeneralController;
class CashController extends GeneralController
{
    /**
     * Process order
     *
     * @return  [type]  [return description]
     */
    public function processOrder(){
        
        return (new ShopCart)->completeOrder();
    }
}
