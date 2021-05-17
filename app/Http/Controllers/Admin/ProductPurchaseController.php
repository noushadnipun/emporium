<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductPurchase;
use App\Models\Product;
class ProductPurchaseController extends Controller
{
    public function index(){
        $purchase = ProductPurchase::orderBy('id', 'desc')->get();
        return view ('admin.product.purchase.index', compact('purchase'));
    }

    public function create(){
        return view ('admin.product.purchase.form');
    }

    public function store(Request $request){
        $data = new ProductPurchase();
        $data->date = $request->date;
        $data->user_id = auth()->user()->id;
        $data->product_id = $request->product_id;
        $data->qty = $request->qty;
        $data->price = $request->price;
        $data->save();


        //Update Product Qty
        $pr = Product::find($request->product_id);
        $pr->total_stock = $pr->total_stock + $request->qty;
        $pr->current_stock = $pr->current_stock + $request->qty;
        $pr->save();
        return redirect()->route('admin_purchase_product_index')->with('success', 'Addedd Successfully');
    }

    public function update(Request $request){

    }
}
