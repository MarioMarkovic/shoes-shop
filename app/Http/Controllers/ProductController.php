<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;
use App\Quantity_size;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function create() 
    {
    	$cat = Category::all();
    	$categories = [];
    	foreach ($cat as $category) {
    		$categories[$category->id] = $category->name;
    	}
        return view('admin.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
    	$prod = Product::where('catalog_number', '=', $request->input('catalog_number'))->get();
    	if(count($prod) > 0) {
    		return back()->with('error_message', 'Product with this catalog number already exists!')->withInput();
    	} else {
	    	$filenameWithExt = $request->image->getClientOriginalName();
	    	// Get just filename without extension
	    	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// Get extension
			$extension = $request->image->getClientOriginalExtension();
			// Create new filename
			$filenameTo = $filename.'_'.time();
			$filenameToStore = $filename.'_'.time().'.'.$extension;
			$request->image->storeAs('images', $filenameToStore, 'public');
	    	$product = new Product;
	    	$product->name = $request->input('name');
	    	$product->image = $filenameToStore;
	    	$product->description = $request->input('description');
	    	$product->price = $request->input('price');
	    	$product->discount = $request->input('discount');
	    	$product->catalog_number = $request->input('catalog_number');
	    	$product->category_id = $request->input('category_id');
	    	$product->save();

	    	foreach(array_combine($request->input('size'), $request->input('quantity')) as $size => $quantity ) {
	    		$quantity_size = new Quantity_size;
	    		$quantity_size->size = $size;
	    		$quantity_size->quantity = $quantity;
	    		$quantity_size->product_id = $product->id;
	    		$quantity_size->save();	
	    	}
	    	return redirect()->route('admin.product.create')->with('success_message', 'New product created!');
    	}
    }

    public function show($id, Request $request)
    {
        if($request->input('search') == null) {
    	   $products = Product::where('category_id', '=', $id)->orderBy('catalog_number')->paginate(10); 
        } else {
            $this->validate($request, [
                'search' => 'required|integer|digits_between:3,10'
            ]);
            $products = Product::where('category_id', '=', $id)->where('catalog_number', '=', $request->input('search'))->get(); 
        }
    	$category = Category::where('id', '=', $id)->first();
    	if(isset($category)) {
    		$name = ucfirst(strtolower($category->name));
    		return view('admin.product.show', [ 'products' => $products, 'name' => $name ]);
    	} else {
    		return view('admin.product.show', [ 'products' => $products ]);
    	}	
    }

    public function fullView($id)
    {
    	$product = Product::with('quantity_size', 'category')->find($id);
    	return view('admin.product.fullView', [ 'product' => $product ]);
    }

    public function edit($id)
    {
    	$product = Product::with('quantity_size')->findOrFail($id);
    	$categories = Category::all();
    	return view('admin.product.edit', [ 'product' => $product, 'categories' => $categories ]);	
    }

    public function update($id, Request $request)
    {
    	$this->validate($request, [
            'name'              => 'required|string|max:191',
            'image'             => 'image|max:1999',  
            'description'       => 'required|string', 
            'price'             => 'required|numeric|min:1|max:10000.00|regex:/^\d*(\.\d{1,2})?$/',
            'discount'          => 'integer|min:1|digits_between:1,2|nullable', 
            'catalog_number'    => 'required|integer|digits_between:3,10', 
            'category_id'       => 'required|integer',
            'size'              => 'required|array|min:1',
            'size.*'            => 'required|integer|digits:2',
            'quantity'          => 'required|array|min:1',
            'quantity.*'        => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);

        if($_FILES['image']['name'] == "") {

        	$filenameToStore = $product->image;

        } else {

        	unlink(public_path()."/storage/images/".$product->image);
        	$filenameWithExt = $request->image->getClientOriginalName();
	    	// Get just filename without extension
	    	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			// Get extension
			$extension = $request->image->getClientOriginalExtension();
			// Create new filename
			$filenameTo = $filename.'_'.time();
			$filenameToStore = $filename.'_'.time().'.'.$extension;
			$request->image->storeAs('images', $filenameToStore, 'public');

        }

    	$product->name = $request->input('name');
    	$product->image = $filenameToStore;
    	$product->description = $request->input('description');
    	$product->price = $request->input('price');
    	$product->discount = $request->input('discount');
    	$product->catalog_number = $request->input('catalog_number');
    	$product->category_id = $request->input('category_id');
    	$product->save();

		$qtyDelete = Quantity_size::where('product_id', '=', $id)->delete();

		foreach(array_combine($request->input('size'), $request->input('quantity')) as $size => $quantity ) {

    		$quantity_size = new Quantity_size;
    		$quantity_size->size = $size;
    		$quantity_size->quantity = $quantity;
    		$quantity_size->product_id = $product->id;
    		$quantity_size->save();

    	}
	    
	    return redirect()->route('admin.dashboard')->with('success_message', 'Product saved!');
    }

    public function destroy($id)
    {
    	$qtyDelete = Quantity_size::where('product_id', '=', $id)->delete();
    	$product = Product::findOrFail($id);
    	unlink(public_path()."/storage/images/".$product->image);
    	$product->delete();

    	return redirect()->route('admin.dashboard')->with('success_message', 'Product deleted!');
    }
}
