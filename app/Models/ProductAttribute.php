<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded =[];

    public function get_vendor_product()
    {
        return $this->belongsTo(VendorProduct::class,'vendor_product_id');
    }
}
