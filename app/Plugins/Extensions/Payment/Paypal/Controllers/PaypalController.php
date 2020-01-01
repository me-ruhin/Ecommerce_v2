<?php
#App\Plugins\Extension\Payment\Paypal\Controllers\PaypalController.php
namespace App\Plugins\Extensions\Payment\Paypal\Controllers;


use App\Http\Controllers\ShopCart;
use App\Models\ShopOrder;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Request;
use App\Models\ShopProduct;
use App\Http\Controllers\GeneralController;
class PaypalController extends GeneralController
{

   
    // Context API
    private $apiContext;
    // List items of order
    private $itemList;
    private $paymentCurrency;
    // Total amount
    private $totalAmount;
    // Return link after payment success
    private $returnUrl;
    // return link when customer click cancel
    private $cancelUrl;
    public function __construct()
    {
        $paypal_env = config('paypal');
        $client_id = empty(sc_config('paypal_client_id')) ? $paypal_env['client_id'] : sc_config('paypal_client_id');
        $secret = empty(sc_config('paypal_secrect')) ? $paypal_env['secret'] : sc_config('paypal_secrect');
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $client_id,
                $secret
            )
        );
        $this->apiContext->setConfig([
            'mode' => sc_config('paypal_mode'),
            'http.ConnectionTimeOut' => 30,
            'log.logEnabled' => sc_config('paypal_log'),
            'log.FileName' => storage_path() . '/' . sc_config('paypal_path_log'),
            'log.LogLevel' => sc_config('paypal_logLevel'),
        ]);
        $this->paymentCurrency = sc_config('paypal_currency');
        $this->totalAmount = 0;
    }

/**
 * Set payment currency
 *
 * @param string $currency String name of currency
 * @return self
 */
    public function setCurrency($currency)
    {
        $this->paymentCurrency = $currency;

        return $this;
    }

    /**
     * Get current payment currency
     *
     * @return string Current payment currency
     */
    public function getCurrency()
    {
        return $this->paymentCurrency;
    }

/**
 * Add item to list
 *
 * @param array $itemData Array item data
 * @return self
 */
    public function setItem($itemData)
    {

        if (count($itemData) === count($itemData, COUNT_RECURSIVE)) {
            $itemData = [$itemData];
        }

        // Duyệt danh sách các item
        foreach ($itemData as $data) {
            $item = new Item();

            $item->setName($data['name'])
                ->setCurrency($this->paymentCurrency)
                ->setSku($data['sku']) //
                ->setQuantity($data['quantity'])
                ->setPrice($data['price']);
            $this->itemList[] = $item;
            $this->totalAmount += $data['price'] * $data['quantity'];

        }
        return $this;
    }

    /**
     * Get list item
     *
     * @return array List item
     */
    public function getItemList()
    {
        return $this->itemList;
    }
/**
 * Get total amount
 *
 * @return mixed Total amount
 */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set return URL
     *
     * @param string $url Return URL for payment process complete
     * @return self
     */
    public function setReturnUrl($url)
    {
        $this->returnUrl = $url;

        return $this;
    }

    /**
     * Get return URL
     *
     * @return string Return URL
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * Set cancel URL
     *
     * @param $url Cancel URL for payment
     * @return self
     */
    public function setCancelUrl($url)
    {
        $this->cancelUrl = $url;

        return $this;
    }

    /**
     * Get cancel URL of payment
     *
     * @return string Cancel URL
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * Create payment
     *
     * @param string $transactionDescription Description for transaction
     * @return mixed Paypal checkout URL or false
     */
    public function createPayment($transactionDescription)
    {
        $checkoutUrl = false;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();
        $itemList->setItems($this->itemList);

        $amount = new Amount();
        $amount->setCurrency($this->paymentCurrency)
            ->setTotal($this->totalAmount);

        // Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($transactionDescription);

        // Đường dẫn để xử lý một thanh toán thành công.
        $redirectUrls = new RedirectUrls();

        // Kiểm tra xem có tồn tại đường dẫn khi người dùng hủy thanh toán
        // hay không. Nếu không, mặc định chúng ta sẽ dùng luôn $redirectUrl
        if (is_null($this->cancelUrl)) {
            $this->cancelUrl = $this->returnUrl;
        }

        $redirectUrls->setReturnUrl($this->returnUrl)
            ->setCancelUrl($this->cancelUrl);

        // Khởi tạo một payment
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        // Thực hiện việc tạo payment
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $paypalException) {
            throw new \Exception($paypalException->getMessage());
        }

        // Nếu việc thanh tạo một payment thành công. Chúng ta sẽ nhận
        // được một danh sách các đường dẫn liên quan đến việc
        // thanh toán trên PayPal
        foreach ($payment->getLinks() as $link) {
            // Duyệt từng link và lấy link nào có rel
            // là approval_url rồi gán nó vào $checkoutUrl
            // để chuyển hướng người dùng đến đó.
            if ($link->getRel() == 'approval_url') {
                $checkoutUrl = $link->getHref();
                // Lưu payment ID vào session để kiểm tra
                // thanh toán ở function khác
                session(['paypal_payment_id' => $payment->getId()]);

                break;
            }
        }

        // Trả về url thanh toán để thực hiện chuyển hướng
        return $checkoutUrl;
    }

    /**
     * Get payment status
     *
     * @return mixed Object payment details or false
     */
    public function getPaymentStatus()
    {
        // Khởi tạo request để lấy một số query trên
        // URL trả về từ PayPal
        $request = Request::all();

        // Lấy Payment ID từ session
        $paymentId = session('paypal_payment_id');
        // Xóa payment ID đã lưu trong session
        session()->forget('paypal_payment_id');

        // Kiểm tra xem URL trả về từ PayPal có chứa
        // các query cần thiết của một thanh toán thành công
        // hay không.
        if (empty($request['PayerID']) || empty($request['token'])) {
            return false;
        }

        // Khởi tạo payment từ Payment ID đã có
        $payment = Payment::get($paymentId, $this->apiContext);

        // Thực thi payment và lấy payment detail
        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($request['PayerID']);

        $paymentStatus = $payment->execute($paymentExecution, $this->apiContext);

        return $paymentStatus;
    }

    /**
     * Get payment list
     *
     * @param int $limit Limit number payment
     * @param int $offset Start index payment
     * @return mixed Object payment list
     */
    public function getPaymentList($limit = 10, $offset = 0)
    {
        $params = [
            'count' => $limit,
            'start_index' => $offset,
        ];

        try {
            $payments = Payment::all($params, $this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $paypalException) {
            throw new \Exception($paypalException->getMessage());
        }

        return $payments;
    }

    /**
     * Get payment details
     *
     * @param string $paymentId PayPal payment Id
     * @return mixed Object payment details
     */
    public function getPaymentDetails($paymentId)
    {
        try {
            $paymentDetails = Payment::get($paymentId, $this->apiContext);
        } catch (\PayPal\Exception\PPConnectionException $paypalException) {
            throw new \Exception($paypalException->getMessage());
        }

        return $paymentDetails;
    }

    public function index(Request $request)
    {
        $data = session('dataPayment');
        $order_id = $data['order_id'];
        $currency = $data['currency'];
        unset($data['order_id']);
        unset($data['currency']);
        session()->forget('dataPayment');
        $transactionDescription = "From website";
        try {
            $paypalCheckoutUrl = $this
                ->setCurrency($currency)
                ->setReturnUrl(route('paypal.return', ['order_id' => $order_id]))
                ->setCancelUrl(route('cart'))
                ->setItem($data)
                ->createPayment($transactionDescription);
            if ($paypalCheckoutUrl) {
                return redirect($paypalCheckoutUrl);
            } else {
                $msg = 'Error while process Paypal case';
                (new ShopOrder)->updateStatus($order_id, $status = sc_config('paypal_order_status_faild'), $msg);
                return redirect()->route('cart')->with(["error" => $msg]);
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            (new ShopOrder)->updateStatus($order_id, $status = sc_config('paypal_order_status_faild'), $msg);
            return redirect()->route('cart')->with(["error" => $msg]);
        }

    }

    public function getReturn($order_id)
    {
        if (!empty(session('paypal_payment_id'))) {
            $paymentStatus = $this->getPaymentStatus();
            // dd($paymentStatus);
            if ($paymentStatus) {
                ShopOrder::find($order_id)->update(['transaction' => $paymentStatus->id, 'status' => sc_config('paypal_order_status_success')]);
                //Add history
                $dataHistory = [
                    'order_id' => $order_id,
                    'content' => 'Transaction ' . $paymentStatus->id,
                    'user_id' => auth()->user()->id ?? 0,
                    'order_status_id' => sc_config('paypal_order_status_success'),
                ];
                (new ShopOrder)->addOrderHistory($dataHistory);
                return (new ShopCart)->completeOrder();
            } else {
                return redirect()->route('cart')->with(['error' => 'Have an error paypal']);
            }
        } else {
            return redirect()->route('cart')->with(['error' => 'Can\'t get payment id']);
        }

    }

    /**
     * Process order
     *
     * @return  [type]  [return description]
     */
    public function processOrder(){

        $orderID = session('orderID') ?? 0;
        $dataOrder = session('dataOrder')??null;
        $arrCartDetail = session('arrCartDetail')??null;
        
        if ($orderID && $dataOrder && $arrCartDetail) {

            $dataPayment = [];
            foreach ($arrCartDetail as $item) {
                $product = ShopProduct::find($item['product_id']);
                $dataPayment[] = [
                    'name' => $item['name'],
                    'quantity' => $item['qty'],
                    'price' => sc_currency_value($item['price']),
                    'sku' => $product->sku,
                ];
            }
            $dataPayment[] =
                [
                'name' => 'Shipping',
                'quantity' => 1,
                'price' => $dataOrder['shipping']??0,
                'sku' => 'shipping',
            ];
            $dataPayment[] =
                [
                'name' => 'Discount',
                'quantity' => 1,
                'price' => $dataOrder['discount']??0,
                'sku' => 'discount',
            ];
            $dataPayment['order_id'] = $orderID;
            $dataPayment['currency'] = sc_currency_code();
            return redirect()->route('paypal.index')->with('dataPayment', $dataPayment);
        } else {
            return json_encode(['error'=>1,'msg' => 'Data not correct!']);
        }
    }

}
