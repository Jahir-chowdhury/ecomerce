<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SingleVendor extends Model
{
    protected $guarded=[];
    
    public function get_vendor_product()
    {
        return $this->hasMany(VendorProduct::class,'single_vendor_id');
    }

    public function get_vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
