<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase() {
        return $this->hasMany(Purchase::class);
    }

    public function vendorReturn() {
        return $this->hasMany(VendorReturn::class);
    }
    
    public function expense() {
        return $this->hasMany(Expense::class);
    }

    public function people()
    {
        return $this->morphOne(People::class, 'teamable');
    }

}
