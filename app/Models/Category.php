<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type']; // type: 'hardware' ou 'license'

    public function hardwareItems()
    {
        return $this->hasMany(HardwareItem::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}