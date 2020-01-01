<?php
#app/Models/ShopOrder.php
namespace App\Models;

use App\Models\ShopOrderDetail;
use App\Models\ShopOrderHistory;
use App\Models\ShopOrderTotal;
use App\Models\ShopProduct;
use DB;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    public $table = 'shop_order';
    protected $guarded = [];
    public static $mapStyleStatus = [
        '1' => 'info', //new
        '2' => 'primary', //processing
        '3' => 'warning', //Hold
        '4' => 'danger', //Cancel
        '5' => 'success', //Success
        '6' => 'default', //Failed
    ];

    public function details()
    {
        return $this->hasMany(ShopOrderDetail::class, 'order_id', 'id');
    }
    public function orderTotal()
    {
        return $this->hasMany(ShopOrderTotal::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\ShopUser', 'user_id', 'id');
    }
    public function orderStatus()
    {
        return $this->hasOne(ShopOrderStatus::class, 'id', 'status');
    }
    public function paymentStatus()
    {
        return $this->hasOne(ShopPaymentStatus::class, 'id', 'payment_status');
    }
    public function history()
    {
        return $this->hasMany(ShopOrderHistory::class, 'order_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();
        // before delete() method call this
        static::deleting(function ($order) {
            foreach ($order->details as $key => $orderDetail) {
                $item = ShopProduct::find($orderDetail->product_id);
                //Update stock, sold
                ShopProduct::updateStock($orderDetail->product_id, -$orderDetail->qty);

            }
            $order->details()->delete(); //delete order details
            $order->orderTotal()->delete(); //delete order total
            $order->history()->delete(); //delete history

        });
    }

/**
 * [updateInfo description]
 * Don't apply for fields discount, shiping, received, cause
 * @param  [type] $order_id  [description]
 * @param  [type] $arrFields [description]
 * @return [type]            [description]
 */
    public static function updateInfo($arrFields, $order_id)
    {
        return self::where('id', $order_id)->update($arrFields);
    }

/**
 * Update status order
 * @param  [type]  $order_id
 * @param  integer $status
 * @param  string  $msg
 */
    public function updateStatus($order_id, $status = 0, $msg = '')
    {
        $uID = auth()->user()->id ?? 0;
        $order = $this->find($order_id);
        if ($order) {
            //Update status
            $order->update(['status' => (int) $status]);

            //Add history
            $dataHistory = [
                'order_id' => $order_id,
                'content' => $msg,
                'user_id' => $uID,
                'admin_id' => 0,
                'order_status_id' => $status,
            ];
            $this->addOrderHistory($dataHistory);
        }
    }

//Scort
    public function scopeSort($query)
    {
        return $query->orderBy('id', 'desc');
    }

/**
 * Create new order
 * @param  [array] $dataOrder
 * @param  [array] $dataTotal
 * @param  [array] $arrCartDetail
 * @return [array]
 */
    public function createOrder($dataOrder, $dataTotal, $arrCartDetail)
    {
        try {
            DB::connection('mysql')->beginTransaction();
            $uID = sc_clean($dataOrder['user_id']);
            $currency = sc_clean($dataOrder['currency']);
            $exchange_rate = sc_clean($dataOrder['exchange_rate']);

            //Insert order
            $dataOrder['user_id'] = sc_clean($dataOrder['user_id']);
            $dataOrder['subtotal'] = sc_clean($dataOrder['subtotal']);
            $dataOrder['shipping'] = sc_clean($dataOrder['shipping']);
            $dataOrder['discount'] = sc_clean($dataOrder['discount']);
            $dataOrder['received'] = sc_clean($dataOrder['received']);
            $dataOrder['payment_status'] = sc_clean($dataOrder['payment_status']);
            $dataOrder['shipping_status'] = sc_clean($dataOrder['shipping_status']);
            $dataOrder['status'] = sc_clean($dataOrder['status']);
            $dataOrder['currency'] = sc_clean($dataOrder['currency']);
            $dataOrder['exchange_rate'] = sc_clean($dataOrder['exchange_rate']);
            $dataOrder['total'] = sc_clean($dataOrder['total']);
            $dataOrder['balance'] = sc_clean($dataOrder['balance']);
            $dataOrder['first_name'] = sc_clean($dataOrder['first_name']);
            $dataOrder['last_name'] = sc_clean($dataOrder['last_name']);
            $dataOrder['email'] = sc_clean($dataOrder['email']);
            $dataOrder['address1'] = sc_clean($dataOrder['address1']);
            $dataOrder['address2'] = sc_clean($dataOrder['address2']);
            $dataOrder['country'] = sc_clean($dataOrder['country']);
            $dataOrder['phone'] = sc_clean($dataOrder['phone']);
            $dataOrder['postcode'] = sc_clean($dataOrder['postcode']);
            $dataOrder['company'] = sc_clean($dataOrder['company']);
            $dataOrder['payment_method'] = sc_clean($dataOrder['payment_method']);
            $dataOrder['shipping_method'] = sc_clean($dataOrder['shipping_method']);
            $dataOrder['comment'] = sc_clean($dataOrder['comment']);
            $dataOrder['created_at'] = date('Y-m-d H:i:s');

            $order = ShopOrder::create($dataOrder);
            $orderID = $order->id;
            //End insert order

            //Insert order total
            foreach ($dataTotal as $key => $row) {
                array_walk($row, function (&$v, $k) {
                    return $v = sc_clean($v);
                });
                $row['order_id'] = $orderID;
                $row['created_at'] = date('Y-m-d H:i:s');
                $dataTotal[$key] = $row;
            }
            ShopOrderTotal::insert($dataTotal);
            //End order total

            //Order detail
            foreach ($arrCartDetail as $cartDetail) {
                $pID = $cartDetail['product_id'];
                $product = ShopProduct::find($pID);
                //If product out of stock
                if (!sc_config('product_buy_out_of_stock') && $product->stock < $cartDetail['qty']) {
                    return $return = ['error' => 1, 'msg' => trans('cart.over', ['item' => $product->sku])];
                }
                //
                $cartDetail['order_id'] = $orderID;
                $cartDetail['currency'] = $currency;
                $cartDetail['exchange_rate'] = $exchange_rate;
                $cartDetail['sku'] = $product->sku;
                $this->addOrderDetail($cartDetail);

                //Update stock and sold
                ShopProduct::updateStock($pID, $cartDetail['qty']);
            }
            //End order detail

            //Add history
            $dataHistory = [
                'order_id' => $orderID,
                'content' => 'New order',
                'user_id' => $uID,
                'order_status_id' => $order->status,
            ];
            $this->addOrderHistory($dataHistory);

            //Process Discount
            $codeDiscount = session('Discount') ?? '';
            if ($codeDiscount) {
                if (!empty(sc_config('Discount'))) {
                    $moduleClass = sc_get_class_extension_controller($code = 'Total', $key = 'Discount');
                    $returnModuleDiscount = (new $moduleClass)->apply($codeDiscount, $uID, $msg = 'Order #' . $orderID);
                    $arrReturnModuleDiscount = json_decode($returnModuleDiscount, true);
                    if ($arrReturnModuleDiscount['error'] == 1) {
                        if ($arrReturnModuleDiscount['msg'] == 'error_code_not_exist') {
                            $msg = trans('promotion.process.invalid');
                        } elseif ($arrReturnModuleDiscount['msg'] == 'error_code_cant_use') {
                            $msg = trans('promotion.process.over');
                        } elseif ($arrReturnModuleDiscount['msg'] == 'error_code_expired_disabled') {
                            $msg = trans('promotion.process.expire');
                        } elseif ($arrReturnModuleDiscount['msg'] == 'error_user_used') {
                            $msg = trans('promotion.process.used');
                        } elseif ($arrReturnModuleDiscount['msg'] == 'error_uID_input') {
                            $msg = trans('promotion.process.user_id_invalid');
                        } elseif ($arrReturnModuleDiscount['msg'] == 'error_login') {
                            $msg = trans('promotion.process.must_login');
                        } else {
                            $msg = trans('promotion.process.undefined');
                        }
                        return redirect()->route('cart')->with(['error_discount' => $msg]);
                    }
                }
            }
            // End process Discount

            DB::connection('mysql')->commit();
            $return = ['error' => 0, 'orderID' => $orderID, 'msg' => ""];
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();
            $return = ['error' => 1, 'msg' => $e->getMessage()];
        }
        return $return;
    }

/**
 * Add order history
 * @param [array] $dataHistory
 */
    public function addOrderHistory($dataHistory)
    {
        return ShopOrderHistory::create($dataHistory);
    }

/**
 * Add order detail
 * @param [type] $dataDetail [description]
 */
    public function addOrderDetail($dataDetail)
    {
        return ShopOrderDetail::create($dataDetail);
    }
}
