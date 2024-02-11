<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('backend.pages.product.index', compact('products'));
    }

/*
|--------------------------------------------------------------------------
| Create Product
|--------------------------------------------------------------------------
*/

    public function create()
    {

        return view('backend.pages.product.create');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100|unique:products',
                'brand_name' => 'required',
                'cost_price' => 'required',
                'sell_price' => 'required',
            ]);

            if ($validator->fails()) {

                throw new Exception($validator->errors()->first());
            }



            Product::create([
                'name' => $request->input('name'),
                'brand_name' => $request->input('brand_name'),
                'cost_price' => $request->input('cost_price'),
                'sell_price' => $request->input('sell_price'),
            ]);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');
        } catch (Exception $e) {

            //dd($e->getMessage());
            return redirect()
                ->route('product.create')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Product creation failed. ' . $e->getMessage());
        }
    }
/*
|--------------------------------------------------------------------------
| Update Create Product
|--------------------------------------------------------------------------
*/
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.pages.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            // dd($request->all());

            if ($product->title == $request->input('title')) {
                $validator = Validator::make($request->all(), [

                    'brand_name' => 'required',
                    'cost_price' => 'required',
                    'sell_price' => 'required',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:100|unique:products',
                    'brand_name' => 'required',
                    'cost_price' => 'required',
                    'sell_price' => 'required',
                ]);
            }

            if ($validator->fails()) {

                throw new Exception($validator->errors()->first());
            }


                $product->update([
                    'name' => $request->input('name'),
                    'brand_name' => $request->input('brand_name'),
                    'cost_price' => $request->input('cost_price'),
                    'sell_price' => $request->input('sell_price'),

                ]);


            return redirect()
                ->route('product.index')
                ->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            return redirect()
                ->route('product.edit', $id)
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Product updated failed.' . $e->getMessage());
        }
    }

/*
|--------------------------------------------------------------------------
| Delete Product
|--------------------------------------------------------------------------
*/

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()
                ->route('product.index')
                ->with('success', 'product deleted successfully.');
        } catch (Exception $e) {
            return redirect()
                ->route('product.index')
                ->with('error', 'product deleted failed.');
        }
    }
}
