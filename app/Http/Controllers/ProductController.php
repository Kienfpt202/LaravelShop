<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::all();
        return view('homepage', compact('products'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('categories',
        'tags'
    ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $product = new Product($request->all());

    // Di chuyển và lưu trữ hình ảnh
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->move(public_path('images'), $imageName);
        $product->image = 'images/' . $imageName;
    }

    $product->save();
    $product->tags()->attach($request->tags);
    return redirect()->route('products.index');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.edit', compact('product', 'categories','tags'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        $product->tags()->sync($request->tags);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }

    /**
     * Search products by title.
     */
    public function search(Request $request)
    {
        $products = Product::where('title', 'like', '%' . $request->search . '%')->get();
        return view('products.index', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('detail', compact('product'));

    }
    public function Cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" =>1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'product has been added to cart!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'product added to cart.');
        }
    }

    public function deleteCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'product successfully deleted.');
        }
        return view('cart');
    }

    /**
     * Display products in ascending order of price.
     */
    public function showByPrice($order = 'asc')
    {
        $products = Product::orderBy('price', $order)->get();
        return view('products.index', compact('products', 'order'));
    }

    public function download($id)
    {
        $product = Product::findOrFail($id);
    
        // Tạo nội dung cho file txt
        $text = "Product Name: " . $product->name . "\n";
        $text .= "Price: $" . $product->price . "\n";
        $text .= "Category: " . $product->category->name . "\n";
        $text .= "Tags: ";
        foreach ($product->tags as $tag) {
            $text .= $tag->name . ", ";
        }
        $text .= "\n";
        $text .= "Description: " . $product->description . "\n";
    
        // Đặt tên file
        $fileName = $product->name . '.txt';
    
        // Lưu file vào thư mục storage/app/public
        Storage::disk('public')->put($fileName, $text);
    
        // Đường dẫn đến file
        $filePath = storage_path('app/public/' . $fileName);
    
        // Trả về file để tải xuống
        return Response::download($filePath);
    }
}
