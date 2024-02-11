<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('transactionProducts')->with('transactionProducts.product')->orderBy('id', 'desc')->get();
        //dd($transactions);

        return view('backend.pages.transaction.index', compact('transactions'));
    }
/*
|--------------------------------------------------------------------------
| Store Transaction
|--------------------------------------------------------------------------
*/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'total_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'discount' => $request->discount,
                'total_price' => $request->total_price,
            ]);

            $TransactionID=$transaction->id;
            $products = $request->input('products');


            foreach ($products as $EachProduct) {
                TransactionProduct::create([
                    'transaction_id' => $TransactionID,
                    'product_id' => $EachProduct['id'],
                    'qty' => $EachProduct['qty'],
                    'sell_price' => $EachProduct['price'],
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Transaction Successfully Completed']);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
/*
|--------------------------------------------------------------------------
| Invoice view from Transaction
|--------------------------------------------------------------------------
*/

    public function show($id)
    {
        $transaction = Transaction::with('transactionProducts')->with('transactionProducts.product')->findOrFail($id);
        return view('backend.pages.transaction.show', compact('transaction'));
    }
}
