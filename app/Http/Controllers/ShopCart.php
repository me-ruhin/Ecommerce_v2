<?php
#app/Http/Controller/ShopCart.php
namespace App\Http\Controllers;

use App\Models\ShopEmailTemplate;
use App\Models\ShopAttributeGroup;
use App\Models\ShopCountry;
use App\Models\ShopOrder;
use App\Models\ShopOrderTotal;
use App\Models\ShopProduct;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopCart extends GeneralController
{
    const ORDER_STATUS_NEW = 1;
    const PAYMENT_UNPAID = 1;
    const SHIPPING_NOTSEND = 1;

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Get list cart: screen get cart
     * @return [type] [description]
     */
    public function getCart()
    {
        session()->forget('paymentMethod'); //destroy paymentMethod
        session()->forget('shippingMethod'); //destroy shippingMethod

        //Shipping
        $moduleShipping = sc_get_extension('shipping');
        $sourcesShipping = sc_get_all_plugin('Extensions', 'shipping');
        $shippingMethod = array();
        foreach ($moduleShipping as $module) {
            if (array_key_exists($module['key'], $sourcesShipping)) {
                $moduleClass = sc_get_class_extension_config('shipping', $module['key']);
                $shippingMethod[$module['key']] = (new $moduleClass)->getData();
            }
        }

        //Payment
        $modulePayment = sc_get_extension('payment');
        $sourcesPayment = sc_get_all_plugin('Extensions', 'payment');
        $paymentMethod = array();
        foreach ($modulePayment as $module) {
            if (array_key_exists($module['key'], $sourcesPayment)) {
                $moduleClass = $sourcesPayment[$module['key']].'\AppConfig';
                $paymentMethod[$module['key']] = (new $moduleClass)->getData();
            }
        }        

        //Total
        $moduleTotal = sc_get_extension('total');
        $sourcesTotal = sc_get_all_plugin('Extensions', 'total');
        $totalMethod = array();
        foreach ($moduleTotal as $module) {
            if (array_key_exists($module['key'], $sourcesTotal)) {
                $moduleClass = $sourcesTotal[$module['key']].'\AppConfig';
                $totalMethod[$module['key']] = (new $moduleClass)->getData();
            }
        } 


        //====================================================
 

        $extensionDiscount = $totalMethod['Discount'] ?? '';
        if (!empty(session('Discount'))) {
            $hasCoupon = true;
        } else {
            $hasCoupon = false;
        }
        $user = auth()->user();
        if ($user) {
            $addressDefaul = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'address1' => $user->address1,
                'address2' => $user->address2,
                'postcode' => $user->postcode,
                'company' => $user->company,
                'country' => $user->country,
                'phone' => $user->phone,
                'comment' => '',
            ];
        } else {
            $addressDefaul = [
                'first_name' => '',
                'last_name' => '',
                'postcode' => '',
                'company' => '',
                'email' => '',
                'address1' => '',
                'address2' => '',
                'country' => '',
                'phone' => '',
                'comment' => '',
            ];
        }
        $shippingAddress = session('shippingAddress') ? session('shippingAddress') : $addressDefaul;
        $objects = ShopOrderTotal::getObjectOrderTotal();
        return view(
            $this->templatePath . '.shop_cart',
            [
                'title' => trans('front.cart_title'),
                'description' => '',
                'keyword' => '',
                'cart' => Cart::content(),
                'shippingMethod' => $shippingMethod,
                'paymentMethod' => $paymentMethod,
                'totalMethod' => $totalMethod,
                'dataTotal' => ShopOrderTotal::processDataTotal($objects),
                'hasCoupon' => $hasCoupon,
                'extensionDiscount' => $extensionDiscount,
                'shippingAddress' => $shippingAddress,
                'uID' => $user->id ?? 0,
                'layout_page' => 'shop_cart',
                'countries' => ShopCountry::getArray(),
                'attributesGroup' => ShopAttributeGroup::pluck('name', 'id')->all(),
            ]
        );
    }

    /**
     * Process Cart, prepare for the checkout screen
     */
    public function processCart()
    {
        if (Cart::count() == 0) {
            return redirect()->route('cart');
        }

        //Not allow for guest
        if (!sc_config('shop_allow_guest') && !auth()->user()) {
            return redirect()->route('login');
        }

        $messages = [
            'max' => trans('validation.max.string'),
            'required' => trans('validation.required'),
        ];
        $validate = [
            'first_name' => 'required|max:100',
            'address1' => 'required|max:100',
            'email' => 'required|string|email|max:255',
            'shippingMethod' => 'required',
            'paymentMethod' => 'required',
        ];
        if(sc_config('customer_lastname')) {
            $validate['last_name'] = 'required|max:100';
        }
        if(sc_config('customer_address2')) {
            $validate['address2'] = 'required|max:100';
        }
        if(sc_config('customer_phone')) {
            $validate['phone'] = 'required|regex:/^0[^0][0-9\-]{7,13}$/';
        }
        if(sc_config('customer_country')) {
            $validate['country'] = 'required|min:2';
        }
        if(sc_config('customer_postcode')) {
            $validate['postcode'] = 'required|min:7';
        }
        if(sc_config('customer_company')) {
            $validate['company'] = 'required|min:3';
        }        
        $v = Validator::make(
            request()->all(), 
            $validate, 
            $messages
        );
        if ($v->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($v->errors());
        }

        //Set session shippingMethod
        session(['shippingMethod' => request('shippingMethod')]);
        //Set session paymentMethod
        session(['paymentMethod' => request('paymentMethod')]);
        //Set session shippingAddress
        session(
            [
                'shippingAddress' => [
                    'first_name' => request('first_name'),
                    'last_name' => request('last_name'),
                    'email' => request('email'),
                    'country' => request('country'),
                    'address1' => request('address1'),
                    'address2' => request('address2'),
                    'phone' => request('phone'),
                    'postcode' => request('postcode'),
                    'company' => request('company'),
                    'comment' => request('comment'),
                ],
            ]
        );
        return redirect()->route('checkout');
    }

    /**
     * Checkout screen
     * @return [view]
     */
    public function getCheckout()
    {
        if (
            !session('shippingMethod') ||
            !session('paymentMethod') ||
            !session('shippingAddress')
        ) {
            return redirect()->route('cart');
        }
        //====================================================
        $paymentMethod = session('paymentMethod');
        $shippingMethod = session('shippingMethod');
        $shippingAddress = session('shippingAddress');

        //Shipping
        $classShippingMethod = sc_get_class_extension_config('Shipping', $shippingMethod);
        $shippingMethodData = (new $classShippingMethod)->getData();

        //Payment
        $classPaymentMethod = sc_get_class_extension_config('Payment', $paymentMethod);
        $paymentMethodData = (new $classPaymentMethod)->getData();

        $objects = ShopOrderTotal::getObjectOrderTotal();
        $dataTotal = ShopOrderTotal::processDataTotal($objects);

        //Set session dataTotal
        session(['dataTotal' => $dataTotal]);

        return view(
            $this->templatePath . '.shop_checkout',
            [
                'title' => trans('front.checkout_title'),
                'description' => '',
                'keyword' => '',
                'cart' => Cart::content(),
                'dataTotal' => $dataTotal,
                'paymentMethodData' => $paymentMethodData,
                'shippingMethodData' => $shippingMethodData,
                'shippingAddress' => $shippingAddress,
                'attributesGroup' => ShopAttributeGroup::getList(),
            ]
        );
    }

    /**
     * add to cart by post, always use page product detail
     * @return [type]           [description]
     */
    public function addToCart()
    {
        $data = request()->all();
        $product_id = $data['product_id'];
        $form_attr = $data['form_attr'] ?? null;
        $qty = $data['qty'];
        $product = ShopProduct::find($product_id);
        if ($product->allowSale()) {
            $options = array();
            $options = $form_attr;
            $dataCart = array(
                'id' => $product_id,
                'name' => $product->sku,
                'qty' => $qty,
                'price' => $product->getFinalPrice(),
            );
            if ($options) {
                $dataCart['options'] = $options;
            }
            Cart::add($dataCart);
            return redirect()->route('cart')
                ->with(
                    ['message' => trans('cart.success', ['instance' => 'cart'])]
                );
        } else {
            return redirect()->route('cart')
                ->with(
                    ['error' => trans('cart.dont_allow_sale')]
                );
        }

    }

    /**
     * Add new order
     */
    public function addOrder(Request $request)
    {
        if (Cart::count() == 0) {
            return redirect()->route('home');
        }
        //Not allow for guest
        if (!sc_config('shop_allow_guest') && !auth()->user()) {
            return redirect()->route('login');
        } //
        $data = request()->all();
        if (!$data) {
            return redirect()->route('cart');
        } else {
            $dataTotal = session('dataTotal') ?? [];
            $shippingAddress = session('shippingAddress') ?? [];
            $payment_method = session('paymentMethod') ?? '';
            $shipping_method = session('shippingMethod') ?? '';
        }

        $uID = auth()->user()->id ?? 0;
        //Process total
        $subtotal = (new ShopOrderTotal)->sumValueTotal('subtotal', $dataTotal); //sum total
        $shipping = (new ShopOrderTotal)->sumValueTotal('shipping', $dataTotal); //sum shipping
        $discount = (new ShopOrderTotal)->sumValueTotal('discount', $dataTotal); //sum discount
        $received = (new ShopOrderTotal)->sumValueTotal('received', $dataTotal); //sum received
        $total = (new ShopOrderTotal)->sumValueTotal('total', $dataTotal);
        //end total

        $dataOrder['user_id'] = $uID;
        $dataOrder['subtotal'] = $subtotal;
        $dataOrder['shipping'] = $shipping;
        $dataOrder['discount'] = $discount;
        $dataOrder['received'] = $received;
        $dataOrder['payment_status'] = self::PAYMENT_UNPAID;
        $dataOrder['shipping_status'] = self::SHIPPING_NOTSEND;
        $dataOrder['status'] = self::ORDER_STATUS_NEW;
        $dataOrder['currency'] = sc_currency_code();
        $dataOrder['exchange_rate'] = sc_currency_rate();
        $dataOrder['total'] = $total;
        $dataOrder['balance'] = $total + $received;
        $dataOrder['first_name'] = $shippingAddress['first_name'];
        $dataOrder['last_name'] = $shippingAddress['last_name'];
        $dataOrder['email'] = $shippingAddress['email'];
        $dataOrder['address1'] = $shippingAddress['address1'];
        $dataOrder['address2'] = $shippingAddress['address2'];
        $dataOrder['country'] = $shippingAddress['country'];
        $dataOrder['phone'] = $shippingAddress['phone'];
        $dataOrder['postcode'] = $shippingAddress['postcode']??null;
        $dataOrder['company'] = $shippingAddress['company']??null;
        $dataOrder['payment_method'] = $payment_method;
        $dataOrder['shipping_method'] = $shipping_method;
        $dataOrder['comment'] = $shippingAddress['comment'];
        $dataOrder['user_agent'] = $request->header('User-Agent');
        $dataOrder['ip'] = $request->ip();
        $dataOrder['created_at'] = date('Y-m-d H:i:s');

        $arrCartDetail = [];
        foreach (Cart::content() as $cartItem) {
            $arrDetail['product_id'] = $cartItem->id;
            $arrDetail['name'] = $cartItem->name;
            $arrDetail['price'] = sc_currency_value($cartItem->price);
            $arrDetail['qty'] = $cartItem->qty;
            $arrDetail['attribute'] = ($cartItem->options) ? json_encode($cartItem->options) : null;
            $arrDetail['total_price'] = sc_currency_value($cartItem->price) * $cartItem->qty;
            $arrCartDetail[] = $arrDetail;
        }

        //Set session info order
        session(['dataOrder' => $dataOrder]);
        session(['arrCartDetail' => $arrCartDetail]);

        //Create new order
        $createOrder = (new ShopOrder)->createOrder($dataOrder, $dataTotal, $arrCartDetail);

        if ($createOrder['error'] == 1) {
            return redirect()->route('cart')->with(['error' => $createOrder['msg']]);
        }
        //Set session orderID
        session(['orderID' => $createOrder['orderID']]);


        $paymentMethod = sc_get_class_extension_controller('Payment', session('paymentMethod'));

        return (new $paymentMethod)->processOrder();

    }

    /**
     * [addToCartAjax description]
     * @param Request $request [description]
     */
    public function addToCartAjax(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('cart');
        }
        $instance = request('instance') ?? 'default';
        $cart = \Cart::instance($instance);

        $id = request('id');
        $product = ShopProduct::find($id);
        $html = '';
        switch ($instance) {
            case 'default':
                if ($product->attributes->count() || $product->kind == SC_PRODUCT_GROUP) {
                    //Products have attributes or kind is group,
                    //need to select properties before adding to the cart
                    return response()->json(
                        [
                            'error' => 1,
                            'redirect' => $product->getUrl(),
                            'msg' => '',
                        ]
                    );
                }

                if ($product->allowSale()) {
                    $cart->add(
                        array(
                            'id' => $id,
                            'name' => $product->name,
                            'qty' => 1,
                            'price' => $product->getFinalPrice(),
                        )
                    );
                } else {
                    return response()->json(
                        [
                            'error' => 1,
                            'msg' => trans('cart.dont_allow_sale'),
                        ]
                    );
                }
                break;

            default:
                //Wishlist or Compare...
                ${'arrID' . $instance} = array_keys($cart->content()->groupBy('id')->toArray());
                if (!in_array($id, ${'arrID' . $instance})) {
                    try {
                        $cart->add(
                            array(
                                'id' => $id,
                                'name' => $product->name,
                                'qty' => 1,
                                'price' => $product->getFinalPrice(),
                            )
                        );
                    } catch (\Exception $e) {
                        return response()->json(
                            [
                                'error' => 1,
                                'msg' => $e->getMessage(),
                            ]
                        );
                    }

                } else {
                    return response()->json(
                        [
                            'error' => 1,
                            'msg' => trans('cart.exist', ['instance' => $instance]),
                        ]
                    );
                }
                break;
        }

        $carts = \Cart::getListCart($instance);
        if ($instance == 'default' && $carts['count']) {
            $html .= '<div><div class="shopping-cart-list">';
            foreach ($carts['items'] as $item) {
                $html .= '<div class="product product-widget"><div class="product-thumb">';
                $html .= '<img src="' . $item['image'] . '" alt="">';
                $html .= '</div>';
                $html .= '<div class="product-body">';
                $html .= '<h3 class="product-price">' . $item['price'] . ' <span class="qty">x' . $item['qty'] . '</span></h3>';
                $html .= '<h2 class="product-name"><a href="' . $item['url'] . '">' . $item['name'] . '</a></h2>';
                $html .= '</div>';
                $html .= '<a href="' . route("cart.remove", ['id' => $item['rowId']]) . '"><button class="cancel-btn"><i class="fa fa-trash"></i></button></a>';
                $html .= '</div>';
            }
            $html .= '</div></div>';
            $html .= '<div class="shopping-cart-btns">
                    <a href="' . route('cart') . '"><button class="main-btn">' . trans('front.cart_title') . '</button></a>
                    <a href="' . route('checkout') . '"><button class="primary-btn">' . trans('front.checkout_title') . ' <i class="fa fa-arrow-circle-right"></i></button></a>
                  </div>';
        }
        return response()->json(
            [
                'error' => 0,
                'count_cart' => $carts['count'],
                'instance' => $instance,
                'subtotal' => $carts['subtotal'],
                'html' => $html,
                'msg' => trans('cart.success', ['instance' => ($instance == 'default') ? 'cart' : $instance]),
            ]
        );

    }

    /**
     * [updateToCart description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateToCart(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->route('cart');
        }
        $id = request('id');
        $rowId = request('rowId');
        $product = ShopProduct::find($id);
        $new_qty = request('new_qty');
        if ($product->stock < $new_qty && !sc_config('product_buy_out_of_stock')) {
            return response()->json(
                [
                    'error' => 1,
                    'msg' => trans('cart.over', ['item' => $product->sku]),
                ]
            );
        } else {
            Cart::update($rowId, ($new_qty) ? $new_qty : 0);
            return response()->json(
                ['error' => 0,
                ]
            );
        }

    }

    /**
     * [wishlist description]
     * @return [type] [description]
     */
    public function wishlist()
    {

        $wishlist = Cart::instance('wishlist')->content();
        return view($this->templatePath . '.shop_wishlist',
            array(
                'title' => trans('front.wishlist'),
                'description' => '',
                'keyword' => '',
                'wishlist' => $wishlist,
                'layout_page' => 'shop_wishlist',
            )
        );
    }

    /**
     * [compare description]
     * @return [type] [description]
     */
    public function compare()
    {
        $compare = Cart::instance('compare')->content();
        return view($this->templatePath . '.shop_compare',
            array(
                'title' => trans('front.compare'),
                'description' => '',
                'keyword' => '',
                'compare' => $compare,
                'layout_page' => 'product_compare',
            )
        );
    }

    /**
     * [clearCart description]
     * @return [type] [description]
     */
    public function clearCart()
    {
        Cart::destroy();
        return redirect()->route('cart');
    }

    /**
     * Remove item from cart
     * @author Naruto
     */
    public function removeItem($id = null)
    {
        if ($id === null) {
            return redirect()->route('cart');
        }

        if (array_key_exists($id, Cart::content()->toArray())) {
            Cart::remove($id);
        }
        return redirect()->route('cart');
    }

    /**
     * [removeItem_wishlist description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function removeItemWishlist($id = null)
    {
        if ($id === null) {
            return redirect()->route('wishlist');
        }

        if (array_key_exists($id, Cart::instance('wishlist')->content()->toArray())) {
            Cart::instance('wishlist')->remove($id);
        }
        return redirect()->route('wishlist');
    }

    /**
     * [removeItemCompare description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function removeItemCompare($id = null)
    {
        if ($id === null) {
            return redirect()->route('compare');
        }

        if (array_key_exists($id, Cart::instance('compare')->content()->toArray())) {
            Cart::instance('compare')->remove($id);
        }
        return redirect()->route('compare');
    }

    /**
     * Complete order
     *
     * @return  [type]  [return description]
     */
    public function completeOrder()
    {
        $orderID = session('orderID') ??0;
        if($orderID == 0){
            return redirect()->route('home', ['error' => 'Error Order ID!']);
        }
        Cart::destroy(); // destroy cart

        session()->forget('paymentMethod'); //destroy paymentMethod
        session()->forget('shippingMethod'); //destroy shippingMethod
        session()->forget('totalMethod'); //destroy totalMethod
        session()->forget('otherMethod'); //destroy otherMethod
        session()->forget('Discount'); //destroy Discount
        session()->forget('dataTotal'); //destroy dataTotal
        session()->forget('dataOrder'); //destroy dataOrder
        session()->forget('arrCartDetail'); //destroy arrCartDetail
        session()->forget('orderID'); //destroy arrCartDetail

        if (sc_config('order_success_to_admin') || sc_config('order_success_to_customer')) {
            $data = ShopOrder::with('details')->find($orderID)->toArray();
            $checkContent = (new ShopEmailTemplate)->where('group', 'order_success_to_admin')->where('status', 1)->first();
            $checkContentCustomer = (new ShopEmailTemplate)->where('group', 'order_success_to_customer')->where('status', 1)->first();
            if ($checkContent || $checkContentCustomer) {
                $orderDetail = '';
                $orderDetail .= '<tr>
                                    <td>' . trans('email.order.sort') . '</td>
                                    <td>' . trans('email.order.sku') . '</td>
                                    <td>' . trans('email.order.name') . '</td>
                                    <td>' . trans('email.order.price') . '</td>
                                    <td>' . trans('email.order.qty') . '</td>
                                    <td>' . trans('email.order.total') . '</td>
                                </tr>';
                foreach ($data['details'] as $key => $detail) {
                    $orderDetail .= '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $detail['sku'] . '</td>
                                    <td>' . $detail['name'] . '</td>
                                    <td>' . sc_currency_render($detail['price'], '', '', '', false) . '</td>
                                    <td>' . number_format($detail['qty']) . '</td>
                                    <td align="right">' . sc_currency_render($detail['total_price'], '', '', '', false) . '</td>
                                </tr>';
                }
                $dataFind = [
                    '/\{\{\$title\}\}/',
                    '/\{\{\$orderID\}\}/',
                    '/\{\{\$firstName\}\}/',
                    '/\{\{\$lastName\}\}/',
                    '/\{\{\$toname\}\}/',
                    '/\{\{\$address\}\}/',
                    '/\{\{\$address1\}\}/',
                    '/\{\{\$address2\}\}/',
                    '/\{\{\$email\}\}/',
                    '/\{\{\$phone\}\}/',
                    '/\{\{\$comment\}\}/',
                    '/\{\{\$orderDetail\}\}/',
                    '/\{\{\$subtotal\}\}/',
                    '/\{\{\$shipping\}\}/',
                    '/\{\{\$discount\}\}/',
                    '/\{\{\$total\}\}/',
                ];
                $dataReplace = [
                    trans('order.send_mail.new_title') . '#' . $orderID,
                    $orderID,
                    $data['first_name'],
                    $data['last_name'],
                    $data['first_name'].' '.$data['last_name'],
                    $data['address1'] . ' ' . $data['address2'],
                    $data['address1'],
                    $data['address2'],
                    $data['email'],
                    $data['phone'],
                    $data['comment'],
                    $orderDetail,
                    sc_currency_render($data['subtotal'], '', '', '', false),
                    sc_currency_render($data['shipping'], '', '', '', false),
                    sc_currency_render($data['discount'], '', '', '', false),
                    sc_currency_render($data['total'], '', '', '', false),
                ];

                if (sc_config('order_success_to_admin') && $checkContent) {
                    $content = $checkContent->text;
                    $content = preg_replace($dataFind, $dataReplace, $content);
                    $data_mail = [
                        'content' => $content,
                    ];
                    $config = [
                        'to' => sc_store('email'),
                        'subject' => trans('order.send_mail.new_title') . '#' . $orderID,
                    ];
                    sc_send_mail('mail.order_success_to_admin', $data_mail, $config, []);
                }
                if (sc_config('order_success_to_customer') && $checkContentCustomer) {
                    $contentCustomer = $checkContentCustomer->text;
                    $contentCustomer = preg_replace($dataFind, $dataReplace, $contentCustomer);
                    $data_mail_customer = [
                        'content' => $contentCustomer,
                    ];
                    $config = [
                        'to' => $data['email'],
                        'replyTo' => sc_store('email'),
                        'subject' => trans('order.send_mail.new_title'),
                    ];
                    sc_send_mail('mail.order_success_to_customer', $data_mail_customer, $config, []);
                }
            }

        }

        return redirect()->route('order.success')->with('orderID', $orderID);
    }

    /**
     * Page order success
     *
     * @return  [type]  [return description]
     */
    public function orderSuccess(){

        if(!session('orderID')) {
            return redirect()->route('home');
        }
        return view(
            $this->templatePath . '.shop_order_success',
            [
                'title' => trans('order.success.title'),
                'layout_page' =>'shop_order_success',
            ]
        );
    }

}
