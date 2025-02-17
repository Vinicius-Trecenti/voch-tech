<?php

namespace App\Models;

use App\Observers\BandeiraObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bandeira extends Model
{
    use HasFactory;

    protected $table = 'bandeiras';

    protected $fillable = [
        'nome',
        'grupo_id',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }
}
