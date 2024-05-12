<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function manPower() {
        return $this->hasOne(ManPower::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function income() {
        return $this->hasMany(Income::class);
    }

    public function expense() {
        return $this->hasMany(Expense::class);
    }

    public function people()
    {
        return $this->morphOne(People::class, 'teamable');
    }

}
