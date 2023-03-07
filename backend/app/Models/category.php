<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_code',
    ];
    public function recurring(){
        

        return $this->belongsToMany(Recurring::class);
    }

}