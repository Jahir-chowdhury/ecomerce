<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    protected $guarded=[];
    
    public function get_vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function get_vendor_product_avatar()
    {
        return $this->hasMany(VendorProductAvatar::class,'vendor_product_id');
    }

    public function get_product_attribute()
    {
        return $this->hasMany(ProductAttribute::class,'vendor_product_id');
    }

    public function get_single_vendor()
    {
        return $this->belongsTo(SingleVendor::class,'single_vendor_id');
    }
}
