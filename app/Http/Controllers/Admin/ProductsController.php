<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin/products/view', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'category' => ['required'],
                'image' => ['required'],
                'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'price' => ['required', 'numeric'],
                'description' => ['required',],
                'discount' => ['required', 'numeric'],
                'quantity' => ['required',  'numeric'],

            ]
        );
        $file = $request->file('image');
        $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
        $dir = public_path('/images/product/');
        $file->move($dir, $fileName);
        $addProduct = new Product();
        $addProduct->category_id = $request->input('category');
        $addProduct->dir = '/images/product/';
        $addProduct->image = $fileName;
        $addProduct->name = $request->input('name');
        $addProduct->price = $request->input('price');
        $addProduct->description = $request->input('description');
        $addProduct->discount = $request->input('discount');
        $addProduct->quantity = $request->input('quantity');
        $addProduct->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => Product::findOrFail($product),

        ], compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $this->validate(
            $request,
            [
                'category' => ['required'],
                'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'price' => ['required', 'numeric'],
                'description' => ['required',],
                'discount' => ['required', 'numeric'],
                'quantity' => ['required',  'numeric'],

            ]
        );
        $update = Product::findOrFail($product);
        $update->category_id = $request->input('category');
        $update->name = $request->input('name');
        $update->price = $request->input('price');
        $update->description = $request->input('description');
        $update->discount = $request->input('discount');
        $update->quantity = $request->input('quantity');
        $update->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $delete = Product::findOrFail($product);
        $delete->delete();
        return redirect()->back()->with('success', 'success');
    }
}
