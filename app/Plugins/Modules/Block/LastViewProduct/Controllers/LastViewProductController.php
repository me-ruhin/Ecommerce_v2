<?php
#App\Plugins\Modules\Block\LastViewProduct\Controllers\LastViewProductController.php
namespace App\Plugins\Modules\Block\LastViewProduct\Controllers;
use App\Models\ShopProduct;
use App\Http\Controllers\GeneralController;
class LastViewProductController extends GeneralController
{
    /**
     * Render is required for module block
     *
     * @return  [type]  [return description]
     */
    public function render()
    {
        if (!empty(sc_config('LastViewProduct'))) {
            $arrProductsLastView = array();
            $lastView = empty(\Cookie::get('productsLastView')) ? [] : json_decode(\Cookie::get('productsLastView'), true);
            if ($lastView) {
                arsort($lastView);
            }

            if (count($lastView)) {
                $lastView = array_slice($lastView, 0, 5, true);
                $productsLastView = ShopProduct::whereIn('id', array_keys($lastView))->get();
                foreach ($lastView as $pId => $time) {
                    foreach ($productsLastView as $key => $product) {
                        if ($product['id'] == $pId) {
                            $product['timelastview'] = $time;
                            $arrProductsLastView[] = $product;
                        }
                    }
                }
            }
            return view('Modules/Block/LastViewProduct::LastViewProduct', 
                ['arrProductsLastView' => $arrProductsLastView]
            );
        }
    }
}
