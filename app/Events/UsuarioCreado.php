<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UsuarioCreado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $nombre;
    public $email;
    public $celular;
    public $mensaje;
    /**
     * Create a new event instance.
     */
    public function __construct($nombre, $email, $celular, $mensaje)
    {
        //
        $this->nombre = $nombre;
        $this->email = $email;
        $this->celular = $celular;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
