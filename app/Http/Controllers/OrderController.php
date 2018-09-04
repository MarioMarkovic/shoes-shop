<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
 
		switch ($request->param) {
			case 'paypal':
				$column = 'type_of_payment';
				$param = 'paypal';
				break;
			case 'delivery':
				$column = 'type_of_payment';
				$param = 'delivery';
				break;
			case '1':
				$column = 'status';
				$param = '1';
				break;		
			case '0':
				$column = 'status';
				$param = '0';
				break;
			default:
				$column = 'status';
				$param = '1';
				break;
		}

    	$orders = Order::with('order_items')->where($column, '=', $param)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.order.index', [ 'orders' => $orders ]);
    }

    public function show($id)
    {
    	$order = Order::with('order_items')->findOrFail($id);
    	return view('admin.order.show', [ 'order' => $order ]);
    }

    public function changeOrderStatus(Request $request, $id)
    {

    	Order::findOrFail($id)->update([ 
            'status' => $request->input('status')        
        ]);

        return redirect()->route('admin.dashboard')->with('success_message', 'Order status changed!');
    } 

}
