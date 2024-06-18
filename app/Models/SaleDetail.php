<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_detail';
    protected $primaryKey = 'id_sales_detail';
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id_product', 'id_product');
    }
}
