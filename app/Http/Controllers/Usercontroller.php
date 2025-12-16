<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order; // Needed for Admin Dashboard count
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Usercontroller extends Controller
{
    public function index()
    {
        // 1. Check if logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. If it's an ADMIN, show the Admin Dashboard
        if (Auth::user()->user_type == 'admin') {
            // We fetch the data here so the admin dashboard doesn't crash
            $total_orders = Order::count(); 
            return view('admin.dashboard', compact('total_orders'));
        }

        // 3. If it's a NORMAL USER (or anyone else), REDIRECT TO SHOP
        // This solves "I don't got a user dashboard"
        return redirect()->route('viewallproducts');
    }

    public function home()
    {
        $products = Product::latest()->take(4)->get();
        return view('index', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('product_details', compact('product'));
    }

    public function allProducts()
    {
        $products = Product::all();
        return view('allproducts', compact('products'));
    }

    public function addToCart($id)
    {  
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;

        $product_cart->save();
        return redirect()->back()->with('cart_messages', 'Item added to cart');
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

    public function checkout()
    {
        $userId = Auth::id();
        $cartItems = ProductCart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('cart_messages', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
        ]);

        $userId = Auth::id();

        try {
            DB::beginTransaction();

            $cartItems = ProductCart::with('product')->where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            // Create Order - AUTO COMPLETED status
            $order = Order::create([
                'user_id' => $userId,
                'name' => $request->name,
                'rec_address' => $request->address,
                'phone' => $request->phone,
                'status' => 'completed', // Auto-complete
                'payment_status' => 'paid',
            ]);

            foreach ($cartItems as $item) {
                $product = Product::where('id', $item->product_id)->lockForUpdate()->first();

                if (!$product || $product->product_quantity < 1) {
                    throw new \Exception("Product " . ($product->product_title ?? 'Unknown') . " is out of stock.");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->product_price,
                ]);

                $product->product_quantity -= 1;
                $product->save();
            }

            ProductCart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('viewallproducts')->with('order_success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('cart_messages', 'Order failed: ' . $e->getMessage());
        }
    }
}