<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;

class SaleDetailController extends Controller
{
    public function index()
    {
        $id_sales = session('id_sales');
        $product = Product::orderBy('name_product')->get();
        $customer = Customer::find(session('id_customer'));
        $discount = Sale::find($id_sales)->diskon ?? 0;

        if (! $customer) {
            abort(404);
        }

        return view('sale_detail.index', compact('id_sales', 'product', 'customer', 'discount'));
    }

    public function data($id)
    {
        $detail = SaleDetail::with('product')
            ->where('id_sales', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_items = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['code_product'] = '<span class="label label-success">'. $item->product['code_product'] .'</span';
            $row['name_product'] = $item->product['name_product'];
            $row['sales_price']  = 'Rp. '. format_uang($item->sales_price);
            $row['amount']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_sales_detail .'" value="'. $item->amount .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['action']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('sale_detail.destroy', $item->id_sales_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->sales_price * $item->amount;
            $total_items += $item->amount;
        }
        $data[] = [
            'code_product' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_items hide">'. $total_items .'</div>',
            'name_product' => '',
            'sales_price'  => '',
            'amount'      => '',
            'subtotal'    => '',
            'action'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['action', 'code_product', 'amount'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $product = Product::where('id_product', $request->id_product)->first();
        if (! $product) {
            return response()->json('Data failed to save', 400);
        }

        $detail = new SaleDetail();
        $detail->id_sales = $request->id_sales;
        $detail->id_product = $product->id_product;
        $detail->sales_price = $product->sales_price;
        $detail->amount = 1;
        $detail->subtotal = $product->sales_price;
        $detail->save();

        return response()->json('Data saved successfully', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = SaleDetail::find($id);
        $detail->amount = $request->amount;
        $detail->subtotal = $detail->sales_price * $request->amount;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = saleDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($discount, $total)
    {
        $pay = $total - ($discount / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'pay' => $pay,
            'payrp' => format_uang($pay),
            'terbilang' => ucwords(terbilang($pay). ' Rupiah')
        ];

        return response()->json($data);
    }
}
