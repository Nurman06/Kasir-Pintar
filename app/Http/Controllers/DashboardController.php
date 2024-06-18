<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $productCount = Product::count();
        $customerCount = Customer::count();
        $supplierCount = Supplier::count();
        $purchaseCount = Purchase::count();
        $saleCount = Sale::count();

        return view('home', compact('categoryCount', 'productCount', 'customerCount', 'supplierCount', 'purchaseCount', 'saleCount'));
    }
}
