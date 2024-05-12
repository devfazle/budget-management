<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseSource extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function expense() {
        return $this->hasMany(Expense::class);
    }
    
}
