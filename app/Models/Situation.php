<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function callings(){
        return $this->hasMany(Calling::class, 'id');
    }
}
