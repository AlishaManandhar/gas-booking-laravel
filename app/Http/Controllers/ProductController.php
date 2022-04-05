<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['show','products']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()
            ->sortBy('name');
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = "active";
        $filename = time(). '_' . $request->image->getClientOriginalName();
        $validated['image'] = $filename;
        Product::create($validated);
        $request->image->storeAs('public/products', $filename);
        return redirect()->route('product.create')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image'))
        {
            Storage::delete('public/products/'.$product->image);
            $filename = time(). '_' . $request->image->getClientOriginalName();
            $validated['image'] = $filename;
            $request->image->storeAs('public/products', $filename);
        }
        $product->update($validated);
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function changeProductStatus(Product $product)
    {
        $product->toggleStatus();
        return redirect()->route('product.index')->with('success', 'Product status changed successfully');
    }

    public function products()
    {
        $products = Product::all()
            ->sortBy('name')
            ->where('status', '=','active');

        return view('product.home', compact('products'));
    }
}
