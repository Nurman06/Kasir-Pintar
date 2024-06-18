<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\SaleDetail;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('name')->get();
        return view('sale.index', compact('customer'));
    }

    public function data()
    {
        $sale = Sale::orderBy('id_sales', 'desc')->get();

        return datatables()
            ->of($sale)
            ->addIndexColumn()
            ->addColumn('total_items', function ($sale) {
                return format_uang($sale->total_items);
            })
            ->addColumn('total_price', function ($sale) {
                return 'Rp. '. format_uang($sale->total_price);
            })
            ->addColumn('pay', function ($sale) {
                return 'Rp. '. format_uang($sale->pay);
            })
            ->addColumn('date', function ($sale) { // Add date column
                return tanggal_indonesia($sale->date, false);
            })
            ->addColumn('customer', function ($sale) {
                return $sale->customer->name;
            })
            ->editColumn('discount', function ($sale) {
                return $sale->discount . '%';
            })
            ->addColumn('action', function ($sale) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('sale.show', $sale->id_sales) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('sale.destroy', $sale->id_sales) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($id)
    {
        $sale = new Sale();
        $sale->id_customer = $id;
        $sale->total_items = 0;
        $sale->total_price= 0;
        $sale->discount    = 0;
        $sale->pay       = 0;
        $sale->date = now();
        $sale->save();

        session(['id_sales' => $sale->id_sales]);
        session(['id_customer' => $sale->id_customer]);

        return redirect()->route('sale_detail.index');
    }

    public function store(Request $request)
    {
        $sale = Sale::findOrFail($request->id_sales);
        $sale->total_items = $request->total_items;
        $sale->total_price = $request->total;
        $sale->discount = $request->discount;
        $sale->pay = $request->pay;
        $sale->date = $request->date; 
        $sale->update();

        $detail = SaleDetail::where('id_sales', $sale->id_sales)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_product);
            $product->stock -= $item->amount;
            $product->update();
        }

        return redirect()->route('sale.index');
    }

    public function show($id)
    {
        $detail = SaleDetail::with('product')->where('id_sales', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('code_product', function ($detail) {
                return '<span class="label label-success">'. $detail->product->code_product .'</span>';
            })
            ->addColumn('name_product', function ($detail) {
                return $detail->product->name_product;
            })
            ->addColumn('sales_price', function ($detail) {
                return 'Rp. '. format_uang($detail->sales_price);
            })
            ->addColumn('amount', function ($detail) {
                return format_uang($detail->amount);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['code_product'])
            ->make(true);
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $detail    = SaleDetail::where('id_sales', $sale->id_sales)->get();
        foreach ($detail as $item) {
            $product = Product::find($item->id_product);
            if ($product) {
                $product->stock += $item->amount;
                $product->update();
            }
            $item->delete();
        }

        $sale->delete();

        return response(null, 204);
    }
}
