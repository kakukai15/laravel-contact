<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'gender',
        'message',
        'tel',
        'address',
        'building',
        'category_id',
        'body',
    ];

    public function getFullnameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}
}



