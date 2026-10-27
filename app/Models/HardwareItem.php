<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'serial_number', 'status', 'location', 'purchase_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation polymorphique pour l'historique des attributions
    public function assignments()
    {
        return $this->morphMany(Assignment::class, 'item');
    }
}