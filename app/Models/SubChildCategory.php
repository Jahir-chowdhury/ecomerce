<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubChildCategory extends Model
{
    protected $guarded = [];
    
    public function get_child_category()
    {
        return $this->belongsTo(ChildCategory::class,'child_category_id');
    }
    
    public function get_category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function get_product()
    {
        return $this->hasMany(Product::class,'sub_child_category_id');
    }
}
