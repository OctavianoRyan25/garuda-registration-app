<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function scopeSearch($query, array $searches)
    {
        $query->when($searches['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%');
        });
    }
}
