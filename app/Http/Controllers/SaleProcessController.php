<?php

namespace App\Http\Controllers;

use App\Models\SaleProcess;
use App\Http\Requests\StoreSaleProcessRequest;
use App\Http\Requests\UpdateSaleProcessRequest;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        $product =Product::where('id',$request->product_id)->get()->first();
        $total = $product->product_price * ($request->process_qty);
        SaleProcess::create([
            'invoice_id'=>$request->invoicenumber,
            'product_id'=>$request->product_id,
            'product_price'=>$product->product_price,
            'process_qty'=>$request->process_qty,
            'process_total'=>$total,
        ]);
      



        $process = SaleProcess::where('invoice_id',$request->invoicenumber)->get();
        return  response($process);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $invoicedata = SaleProcess::where('invoice_id',$request->invoicenumber)->get();

        Invoice::create([
            'invoice_id'=>$request->invoicenumber,
            'user_id'=>$request->user_id,
            'total'=>$invoicedata->sum('process_total'),
            'date'=>date('y-m-d')

        ]);
        $myinvoice =Invoice::where('invoice_id',$request->invoicenumber)->get()->first();
        return $myinvoice;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleProcessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleProcess $saleProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleProcess $saleProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleProcessRequest $request, SaleProcess $saleProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleProcess $saleProcess)
    {
        //
    }
}
