<?php

namespace App\Listeners;

use App\Events\UsuarioCreado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Contacto;

class EnviarCorreo
{
    /**
     * Create the event listener.
     */
    public function __construct(UsuarioCreado $event)
    {
        //
        Mail::to('admin_gml@gmail.com')->queue(
            new Contacto($event->nombre, $event->email, $event->celular, $event->mensaje));
       
    }

    /**
     * Handle the event.
     */
    public function handle(UsuarioCreado $event): void
    {
        //
    }
}
