<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preke extends Model
{
    use HasFactory;

    protected $table = 'prekes';

    protected $fillable = [
        'pavadinimas',
        'aprasymas',
        'kaina',
        'prek_kodas',
        'nuotrauka',
        'kategorija_id',
    ];

    public function kategorija()
    {
        return $this->belongsTo(Kategorija::class, 'kategorija_id');
    }
}
