<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all()->pluck('name_category', 'id_category');
        return view('product.index', compact('category'));
    }

    public function data() 
    {
        $product = Product::leftJoin('category', 'category.id_category', 'product.id_category')
            ->select('product.*', 'name_category')
            ->get();

        return datatables()
            ->of($product)
            ->addIndexColumn()
            ->addColumn('code_product', function ($product) {
                return '<span class="label label-success">'. $product->code_product .'</span>';
            })
            ->addColumn('purchase_price', function ($product) {
                return 'Rp. '. format_uang($product->purchase_price);
            })
            ->addColumn('sales_price', function ($product) {
                return 'Rp. '. format_uang($product->sales_price);
            })
            ->addColumn('stock', function ($product) {
                return format_uang($product->stock);
            })
            ->addColumn('action', function($product) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('product.update', $product->id_product) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('product.destroy', $product->id_product) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['action', 'code_product'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::latest()->first() ?? new Product();
        $request['code_product'] = 'P'. add_zero_in_front((int)$product->id_product +1, 6);
        $product = Product::create($request->all());

        return response()->json('Data saved successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json('Data saved successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();

        return response(null, 204);
    }
}
