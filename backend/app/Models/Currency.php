<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate',
        'name',
    ];

    public function recurring(){


        return $this->belongsToMany(Recurring::class);
    }

    public function Goal()
    {
        return $this->hasOne(Goal::class);
    }
}
