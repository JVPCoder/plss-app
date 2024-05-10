<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calling extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'desc',
        'limits',
        'situation_id',
        'creation',
        'solution'
    ];

    protected $dates = [
        'limits',
        'creation',
        'solution',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function situation(){
        return $this->belongsTo(Situation::class, 'situation_id');
    }
}
