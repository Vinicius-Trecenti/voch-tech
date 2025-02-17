<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audits';

    protected $fillable = [
        'evento',
        'user_id',
        'data',
        'ip',
        'auditable_id',
        'auditable_type',
        'detalhes',
    ];

    protected $casts = [
        'data'      => 'datetime',
        'detalhes'  => 'json',
    ];
}
