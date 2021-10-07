<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded=[];
    
    public function get_vendor_product()
    {
        return $this->hasMany(VendorProduct::class,'vendor_id');
    }
    public function get_single_vendor()
    {
        return $this->hasMany(SingleVendor::class,'vendor_id');
    }
}
