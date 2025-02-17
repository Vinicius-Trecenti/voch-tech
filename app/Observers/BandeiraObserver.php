<?php

namespace App\Observers;

use App\Models\Audit;
use App\Models\Bandeira;
use Illuminate\Support\Facades\Auth;

class BandeiraObserver
{
    /**
     * Handle the Bandeira "created" event.
     */
    public function created(Bandeira $bandeira): void
    {
        Audit::create([
            'evento'         => "Criação",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $bandeira->id,
            'auditable_type' => Bandeira::class,
            'detalhes'       => $bandeira->toArray(),
        ]);
    }

    /**
     * Handle the Bandeira "updated" event.
     */
    public function updated(Bandeira $bandeira): void
    {
        Audit::create([
            'evento'         => "Atualização",
            'user_id'        => Auth::user()->id,
            'data'           => now(),
            'ip'             => request()->ip(),
            'auditable_id'   => $bandeira->id,
            'auditable_type' => Bandeira::class,
            'detalhes'       => [
                'antigo' => $bandeira->getOriginal(),
                'novo'   => $bandeira->toArray(),
            ],
        ]);
    }

    /**
     * Handle the Bandeira "deleted" event.
     */
    public function deleted(Bandeira $bandeira): void
    {
        Audit::create([
            'evento'            => "Exclusão",
            'user_id'           => Auth::user()->id,
            'data'              => now(),
            'ip'                => request()->ip(),
            'auditable_id'      => $bandeira->id,
            'auditable_type'    => Bandeira::class,
            'detalhes'          => $bandeira->toArray(),
        ]);
    }

    /**
     * Handle the Bandeira "restored" event.
     */
    public function restored(Bandeira $bandeira): void
    {
        //
    }

    /**
     * Handle the Bandeira "force deleted" event.
     */
    public function forceDeleted(Bandeira $bandeira): void
    {
        //
    }
}
