<?php

namespace App\Observers;

use App\Jobs\SalvarAudit;
use App\Models\Grupo;
use Illuminate\Support\Facades\Auth;

class GrupoObserver
{
    /**
     * Handle the Grupo "created" event.
     */
    public function created(Grupo $grupo): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Criação",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $grupo->id,
            'auditable_type' => Grupo::class,
            'detalhes'       => $grupo->toArray(),
        ]);
    }

    /**
     * Handle the Grupo "updated" event.
     */
    public function updated(Grupo $grupo): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Atualização",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $grupo->id,
            'auditable_type' => Grupo::class,
            'detalhes'       => [
                'antigo' => $grupo->getOriginal(),
                'novo'   => $grupo->toArray(),
            ]
        ]);
    }

    /**
     * Handle the Grupo "deleted" event.
     */
    public function deleted(Grupo $grupo): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Exclusão",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $grupo->id,
            'auditable_type' => Grupo::class,
            'detalhes'       => $grupo->toArray(),
        ]);
    }

    /**
     * Handle the Grupo "restored" event.
     */
    public function restored(Grupo $grupo): void
    {
        //
    }

    /**
     * Handle the Grupo "force deleted" event.
     */
    public function forceDeleted(Grupo $grupo): void
    {
        //
    }
}
