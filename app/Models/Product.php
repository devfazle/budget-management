<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function purchase() {
        return $this->hasMany(Purchase::class);
    }
    
    public function sale() {
        return $this->hasMany(Sale::class);
    }


    public function wastage() {
        return $this->hasMany(Wastage::class);
    }

    public function vendorReturn() {
        return $this->hasMany(VendorReturn::class);
    }

}
