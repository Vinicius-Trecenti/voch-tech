<?php

namespace App\Observers;

use App\Models\Audit;
use App\Models\Unidade;
use Illuminate\Support\Facades\Auth;

class UnidadeObserver
{
    /**
     * Handle the Unidade "created" event.
     */
    public function created(Unidade $unidade): void
    {
        Audit::create([
            'evento'         => "Criação",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $unidade->id,
            'auditable_type' => Unidade::class,
            'detalhes'       => $unidade->toArray(),
        ]);
    }

    /**
     * Handle the Unidade "updated" event.
     */
    public function updated(Unidade $unidade): void
    {
        Audit::create([
            'evento'         => "Atualização",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $unidade->id,
            'auditable_type' => Unidade::class,
            'detalhes'       => [
                'antigo' => $unidade->getOriginal(),
                'novo'   => $unidade->toArray(),
            ],
        ]);
    }

    /**
     * Handle the Unidade "deleted" event.
     */
    public function deleted(Unidade $unidade): void
    {
        Audit::create([
            'evento'         => "Exclusão",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $unidade->id,
            'auditable_type' => Unidade::class,
            'detalhes'       => $unidade->toArray(),
        ]);
    }

    /**
     * Handle the Unidade "restored" event.
     */
    public function restored(Unidade $unidade): void
    {
        //
    }

    /**
     * Handle the Unidade "force deleted" event.
     */
    public function forceDeleted(Unidade $unidade): void
    {
        //
    }
}
