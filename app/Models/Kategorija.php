<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Kategorija modelis
class Kategorija extends Model
{
    use HasFactory;

    // Nustatykite lentelės pavadinimą
    protected $table = 'kategorijos';

    protected $fillable = ['pavadinimas'];

    public function prekes()
    {
        return $this->hasMany(Preke::class);
    }
}
