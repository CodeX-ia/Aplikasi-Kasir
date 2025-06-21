<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::all();
        return view('transaction.index', compact('transaction'));
    }

    public function show($id) {
        $transaction = Transaction::findOrfail($id);
        return view('transaction.show', compact('transaction'));
    }

    public function create(){
        $product = Product::all();
        return view('transaction.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $products = [];

            foreach ($request->products as $productId) {
                $quantity = $request->quantities[$productId] ?? 0;

                if ($quantity < 1) continue;

                $product = Product::find($productId);
                $total += $product->price * $quantity;

                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id() ?? 1,
                'total' => $total,
            ]);

            foreach ($products as $item) {
                // Kurangi stok
                $item['product']->decrement('stock', $item['quantity']);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                ]);
            }

            DB::commit();
            return redirect()->route('transaction.index')->with('success', 'Transaksi Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id){
        $transaction = Transaction::findOrfail($id);
        $transaction->delete();
        return redirect()->route('transaction.index')->with('success', 'Transaksi Berhasil dihapus');
    }
}
