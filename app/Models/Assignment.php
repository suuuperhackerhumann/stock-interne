<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type', 'item_id', 'user_id', 'distributor_id', 'reason', 'pdf_path', 'assigned_at', 'returned_at'
    ];

    // Lien vers l'objet (Matériel ou Licence)
    public function item()
    {
        return $this->morphTo();
    }

    // L'employé qui reçoit
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Le distributeur qui attribue
    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }
}