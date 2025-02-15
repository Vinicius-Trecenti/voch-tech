<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';
    
    protected $fillable = [
        'nome',
    ];

    public function bandeiras()
    {
        return $this->hasMany(Bandeira::class);
    }
}
