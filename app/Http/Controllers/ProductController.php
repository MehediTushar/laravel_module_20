<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // // Search by product_id or description
        // if ($request->has('search')) {
        //     $search = $request->search;
        //     $query->where('product_id', 'like', "%{$search}%")
        //           ->orWhere('description', 'like', "%{$search}%");
        // }

        $searchText = $request->search_text;
        if ($searchText != null) {
            $query->where(function ($query) use ($searchText) {
                $query->where('product_id', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('name', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('stock', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchText . '%');
            });
            // $query->whereLike(['branch_code', 'branch_name', 'branch_type', 'address'], $searchText);
        }

        // Sort by name or price
        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by, 'asc');
        }

        $products = $query->paginate(10);

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $produ_img = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imageFile = $request->file('image');
            $produ_img = 'product' . time() . '.' . $imageFile->extension();
            $imageFile->move(public_path('img/product_img'), $produ_img);
        }
        $data=[
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $produ_img,
            'description' => $request->description,
        ];
    
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::findOrFail($id);
        return view('product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product=Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data=[
            'product_id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            // 'image' => $request->image,
            'description' => $request->description,
        ];

        if(isset($request->image)){
            $produ_img = 'product' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/product_img'), $produ_img);
            $data['image'] = $produ_img;
            $del = 'img/product_img/' . Product::find($id)->image;
            File::delete(public_path($del));
        }

        Product::where('id', $id)->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            $imagePath = 'img/product_img/' . $product->image;
            File::delete(public_path($imagePath));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
