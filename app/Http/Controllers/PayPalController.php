<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Product;
use App\Category;
use App\Cart;
use App\Quantity_size;
use App\Order;
use App\Order_items;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bill;

class PayPalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function payWithPaypal()
    {
        return view('public.payWithPaypal');
    }

    public function checkoutPaypal(Request $request)
    {	
    	$this->validate($request, [
            'first_name'    => 'required|string|max:191',
            'last_name'     => 'required|string|max:191',
            'email'         => 'required|string|email|max:191',
            'city'          => 'required|string|max:191',
            'post_number'   => 'required|integer',
            'street_name'   => 'required|string|max:191',
            'street_number' => 'required|string|max:191',
            'phone'         => 'required|integer'
        ]);
        Session::put('input',$request->input());

        $cart = Session::get('cart');

        $payer = new Payer();

        $payer->setPaymentMethod("paypal");

        $items = [];

        foreach($cart->items as $key => $value) {
            $name = $value['item']['name'];
            $price = $value['item']['price'];  
            $catalog_number = $value['item']['catalog_number']; 
            $quantity = $value['quantity'];
           
            foreach ($value['item']['quantity_size'] as $value) {
            	$item = new Item();
            	$item->setName($name . ' - size: ' . $value['size'])
            		 ->setQuantity($quantity)
            		 ->setSku($catalog_number)
            		 ->setPrice(addslashes($price))
            		 ->setCurrency('EUR');
            }
            	$items[] = $item;
        }    

        $itemList = new ItemList();
        $itemList->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('EUR')
        	   ->setTotal($cart->totalPrice);

       	$transaction = new Transaction();
       	$transaction->setAmount($amount)
       				->setItemList($itemList)
       				->setInvoiceNumber(uniqid());
       	
       	$redirect_urls = new RedirectUrls();
       	$redirect_urls->setReturnUrl(route('public.getPaymentStatus'))
       				  ->setCancelUrl(route('public.cart'));	

       	$payment = new Payment();
       	$payment->setIntent('sale')
       			->setPayer($payer)
       			->setRedirectUrls($redirect_urls)
       			->setTransactions(array($transaction));	

       	$request = clone $payment;					  	 	   

       	try {
   			$payment->create($this->_api_context);

		} catch (PayPal\Exception\PayPalConnectionException $ex) {
    		if(\Config::get('app.debug')) {
    			\Session::put('error_1', 'Connection timeout');
    		} else {
    			Session::put('error_1', 'Some error occur, sorry for incovenient');
    		}
		} 

		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			return redirect()->away($redirect_url);
		}

		Session::put('error_1', 'Unknown error occurred');
		return redirect()->route('public.cart');

	}	

	public function getPaymentStatus(Request $request)
	{
		$paymentId = Session::get('paypal_payment_id');
		Session::forget('paypal_payment_id');
		if(isset($_GET['paymentId'])) {
			if($paymentId == $_GET['paymentId']) {
				$payment = Payment::get($paymentId, $this->_api_context);
				$execution = new PaymentExecution();
				$execution->setPayerId($_GET['PayerID']);
				$result = $payment->execute($execution, $this->_api_context);

				if($result->getState() == 'approved') {
					$cart = Session::get('cart');
					$input = Session::get('input');
			        $order = new Order;

			        $order->token           = $input['_token'];
			        $order->first_name      = $input['first_name'];
			        $order->last_name       = $input['last_name'];
			        $order->email           = $input['email'];
			        $order->city            = $input['city'];
			        $order->post_number     = $input['post_number'];
			        $order->street_name     = $input['street_name'];
			        $order->street_number   = $input['street_number'];
			        $order->phone           = $input['phone'];
			        $order->type_of_payment = "paypal";
			        $order->total_quantity  = $cart->totalQuantity;
			        $order->total_price     = $cart->totalPrice; 

			       $order->save();

			        foreach($cart->items as $key => $value) {

			            $order_items = new Order_items;

			            $order_items->order_id              = $order->id;
			            $order_items->item_name             = $value['item']['name'];
			            $order_items->item_price            = $value['item']['price'];   
			            $order_items->item_catalog_number   = $value['item']['catalog_number'];
			            $order_items->item_total_quantity   = $value['quantity'];
			            $order_items->item_total_price      = $value['price'];

			            foreach ($value['item']['quantity_size'] as $value) {
			                $order_items->item_size = $value['size'];
			                $quantity_size = Quantity_size::findOrFail($value['id']);
			                $quantity_size->quantity = $quantity_size->quantity - $order_items->item_total_quantity;
			                $quantity_size->save();
			            }

			            $order_items->save();

			        }

			        $order_items = Order_items::where('order_id', '=', $order->id)->get();

			        Mail::to($order->email)->send(new Bill($order, $order_items));

			        $request->session()->forget('cart');
			        $request->session()->forget('input');
			        Session::put('success', "Thank You for buying our products. We&#39;we sent you email with order details!");
			        return redirect()->route('public.index');

				} else {

					Session::put('error_1', 'Payment failed');
					return redirect()->route('public.cart');
				}

			} else if(empty($_GET['token']) || empty($_GET['paymentId'])) {
				Session::put('error_1', 'Payment failed');
				return redirect()->route('public.cart');

			} else {
				Session::put('error_1', 'Payment failed');
				return redirect()->route('public.cart');
			}
			
		} else {
			return redirect()->route('public.cart');
		}
	}
}
