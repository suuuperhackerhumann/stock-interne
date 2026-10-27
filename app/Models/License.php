<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'license_key', 'total_seats', 'used_seats', 'expiration_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation polymorphique
    public function assignments()
    {
        return $this->morphMany(Assignment::class, 'item');
    }
}