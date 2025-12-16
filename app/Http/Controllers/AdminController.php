<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order; 

class AdminController extends Controller
{
    // Dashboard Logic
    public function index()
    {
        // Count the total number of orders
        $total_orders = Order::count();
        return view('admin.dashboard', compact('total_orders'));
    }

    // --- Category Management ---
    public function addCategory()
    {
        return view('admin.addcategory');
    }

public function postAddCategory(Request $request)
    {
        // 1. Validate
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name'
        ]);

        // 2. Save
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();

        // 3. Redirect
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function viewCategory()
    {
        $data = Category::all();
        return view('admin.viewcategory', compact('data'));
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

   public function updateCategory($id)
{
    $data = Category::find($id); // You named it $data here
    return view('admin.updatecategory', compact('data'));
}

    public function postUpdateCategory(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();
        return redirect('/view_category')->with('message', 'Category Updated Successfully');
    }

    // --- Product Management ---
    public function addProduct()
    {
        $category = Category::all();
        return view('admin.addproduct', compact('category'));
    }

    public function postAddProduct(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:40960',
        ]);

        // 2. Assign Data
        $product = new Product;
        $product->product_title = $request->title;
        $product->product_description = $request->description;
        $product->product_price = $request->price;
        $product->product_quantity = $request->quantity;
        $product->category = $request->category;

        // 3. Handle Image Upload
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $product->product_image = $imagename;
        }

        // 4. Save
        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function viewProduct()
    {
        $product = Product::paginate(3);
        return view('admin.viewproduct', compact('product'));
    }

    public function deleteProduct($id)
    {
        $data = Product::find($id);
        
        // Remove image if exists
        $image_path = public_path('products/' . $data->product_image);
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $data->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function updateProduct($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.updateproduct', compact('product', 'category'));
    }

    public function postUpdateProduct(Request $request, $id)
    {
        // 1. Validate (Add max size to image)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category' => 'required|string',
            // Increased limit to 40MB as requested before
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:40960', 
        ]);

        $data = Product::find($id);

        // 2. Update fields (Input names match form names)
        $data->product_title = $request->title;
        $data->product_description = $request->description;
        $data->product_price = $request->price;
        $data->product_quantity = $request->quantity;
        $data->category = $request->category;

        // 3. Handle Image
        $image = $request->image;
        if ($image) {
            // Optional: Delete old image
            $old_image_path = public_path('products/' . $data->product_image);
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products', $imagename);
            $data->product_image = $imagename;
        }

        $data->save();
        return redirect('/view_product')->with('message', 'Product Updated Successfully');
    }

    // --- Order Management ---
    public function viewOrder()
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.view_order', compact('orders'));
    }

    public function completeOrder($id)
    {
        $order = Order::find($id);
        
        if ($order) {
            $order->status = 'completed';
            $order->payment_status = 'paid';
            $order->save();
        }

        return redirect()->back()->with('message', 'Order status updated successfully');
    }
}