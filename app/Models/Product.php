<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'description',
        'description_en',
        'amount',
        'old_price',
        'new_price',
        'sub_id',
        'is_special'
    ];

    public function subcategories(){
        return $this->belongsTo(SubCategory::class, 'sub_id');
    }

    public function images(){
        return $this->hasMany(Product_Image::class, 'product_id');
    }
}
