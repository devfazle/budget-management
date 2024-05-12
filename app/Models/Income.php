<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function incomeCategory() {
        return $this->belongsTo(IncomeCategory::class, 'category_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function incomeSource() {
        return $this->belongsTo(IncomeSource::class);
    }
}
