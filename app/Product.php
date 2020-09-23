<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [''];

    protected $casts = [
        'current_price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }

}
