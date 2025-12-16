<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        // Normal users should land on the all products page
        if (Auth::user()->user_type == 'user') {
            return redirect()->route('viewallproducts');
        }

        // Admins still see the admin dashboard
        if (Auth::user()->user_type == 'admin') {
            return view('admin.dashboard');
        }

        // Fallback for any other user types
        return redirect()->route('index');
    }
    

    public function home()
    {
        $products=Product::Latest()->take(4)->get();
        return view('index',compact('products')  );
    }
    public function productDetails($id)
    {
        $product=Product::findOrFail($id);
        return view('product_details',compact('product'));
    }

    public function allProducts()
     {
        $products=Product::all();
        return view('allproducts',compact('products'));
    }

    public function addToCart($id)
     {  
        $product = Product::findOrFail($id);
        $product_cart=new ProductCart();
        $product_cart->user_id=Auth::id();
        $product_cart->product_id=$product->id;

        $product_cart->save();
        return redirect()->back()->with('cart_messages','added to cart');
    }

    public function cart()
    {
        $cartItems = ProductCart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart', compact('cartItems'));
    }

    public function removeFromCart($id)
    {
        $cartItem = ProductCart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return redirect()->back()->with('cart_messages', 'Item removed from cart');
    }
    
}