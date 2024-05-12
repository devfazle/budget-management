<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sale() {
        return $this->hasMany(Sale::class);
    }

    public function people()
    {
        return $this->morphOne(People::class, 'teamable');
    }

}
