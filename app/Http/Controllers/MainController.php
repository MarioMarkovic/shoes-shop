<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Product;
use App\Category;
use App\Cart;
use App\Quantity_size;
use App\Order;
use App\Order_items;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\Bill;

class MainController extends Controller
{
    public function index()
    {
    	$products = Product::with('quantity_size')->orderBy('id', 'DESC')->take(6)->get();
    	return view('public.index', [ 'products' => $products ]);
    }

    public function pages($id)
    {
    	$page = Page::findOrFail($id);
    	return view('public.page', [ 'page' => $page ]);
    }

    public function showProductsByCategory($id)
    {
    	$products = Product::where('category_id', '=', $id)->orderBy('catalog_number')->paginate(6);
    	$category = Category::where('id', '=', $id)->first();
    	return view('public.product-by-category', ['products' => $products, 'category' => $category ]);
    }

    public function productFullView($id)
    {
    	$product = Product::with('quantity_size')->find($id);
    	return view('public.full-view', [ 'product' => $product ]);
    }

    public function search(Request $request)
    {
    	$this->validate($request, [
            'search'  => 'required|string|max:191'
        ]);

    	$item = $request->input('search');
    	$products = Product::with('quantity_size')->where('name', 'LIKE', '%'.$item.'%')->paginate(6);
    	return view('public.search', [ 'products' => $products, 'item' => $item ]);
    }

    public function addToCart(Request $request, $id)
    {
        $this->validate($request, [
            'size_id' => 'integer'
        ]);

        $size_id = $request->input('size_id');
        $product = Product::with(['quantity_size' => function($query) use ($size_id) {
            $query->where('id', '=', $size_id);
        }])->find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $size_id);
        $request->session()->put('cart', $cart);   
        return redirect()->back();
    }

    public function getCart() 
    {
        if(!Session::has('cart')) {
            return view('public.cart');
        } else {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            return view('public.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice ]);
        }
    }

    public function deleteCart(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->back();
    }

    public function deleteCartItem(Request $request, $id) 
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->deleteItem($id);

        if(count($cart->items) <= 0) {
            $request->session('cart')->flush();
            return redirect()->back();
        } else {
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }

    public function addProductQuantity(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required|integer'
        ]);

        $quantityInStock = Quantity_size::find($id);
        $quantity = $request->input('quantity');

        if($quantity <= 0 || $quantity >= $quantityInStock->quantity - 50) {
            return redirect()->back();
        } else {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $cart->updateQuantity($id, $quantity);
            Session::put('cart', $cart);
            return redirect()->back();
        }
    }

    public function paymentOnDelivery()
    {
        return view('public.cart-form');
    }

    public function checkout(Request $request) 
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

        $cart = Session::get('cart');
        $order = new Order;

        $order->token           = $request->input('_token');
        $order->first_name      = $request->input('first_name');
        $order->last_name       = $request->input('last_name');
        $order->email           = $request->input('email');
        $order->city            = $request->input('city');
        $order->post_number     = $request->input('post_number');
        $order->street_name     = $request->input('street_name');
        $order->street_number   = $request->input('street_number');
        $order->phone           = $request->input('phone');
        $order->type_of_payment = "delivery";
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
        Session::put('success', "Thank You for buying our products. We&#39;we sent you email with order details!");
        return redirect()->route('public.index');
    }    
}
