<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id){
        $product = Product::findOrfail($id);
        return view('products.show', compact('product'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|min:1',
        ]);

        Product::create($request->only('name','price','stock'));
        return redirect()->route('product.index')->with('success', 'Produk Berhasil ditambah');
    }

    public function edit(Product $product){
        return view('products.update', compact('product'));
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|min:1',
        ]);

        $product->update($request->only('name','price','stock'));
        return redirect()->route('product.index')->with('success','Produk Berhasil DiUbah.');
    }

    public function destroy(Product $product)
    {
        if ($product->transactionItems()->exists()) {
            return redirect()->route('product.index')->with('error', 'Produk tidak bisa dihapus karena sudah dipakai di transaksi.');
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
