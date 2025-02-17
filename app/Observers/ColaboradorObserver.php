<?php

namespace App\Observers;

use App\Models\Colaborador;
use App\Jobs\SalvarAudit;
use Illuminate\Support\Facades\Auth;

class ColaboradorObserver
{
    /**
     * Handle the Colaborador "created" event.
     */
    public function created(Colaborador $colaborador): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Criação",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $colaborador->id,
            'auditable_type' => Colaborador::class,
            'detalhes'       => $colaborador->toArray(),
        ]);
    }

    /**
     * Handle the Colaborador "updated" event.
     */
    public function updated(Colaborador $colaborador): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Atualização",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $colaborador->id,
            'auditable_type' => Colaborador::class,
            'detalhes'       => [
                'antigo' => $colaborador->getOriginal(),
                'novo'   => $colaborador->toArray(),
            ]
        ]);
    }

    /**
     * Handle the Colaborador "deleted" event.
     */
    public function deleted(Colaborador $colaborador): void
    {
        SalvarAudit::dispatch([
            'evento'         => "Exclusão",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $colaborador->id,
            'auditable_type' => Colaborador::class,
            'detalhes'       => $colaborador->toArray(),
        ]);
    }

    /**
     * Handle the Colaborador "restored" event.
     */
    public function restored(Colaborador $colaborador): void
    {
        //
    }

    /**
     * Handle the Colaborador "force deleted" event.
     */
    public function forceDeleted(Colaborador $colaborador): void
    {
        //
    }
}
