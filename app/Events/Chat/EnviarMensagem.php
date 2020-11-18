<?php

namespace App\Events\Chat;

use App\Models\Mensagem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EnviarMensagem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $mensagem;
    public $notificacaoContato;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Mensagem $mensagem, int $notificacaoContato)
    {
        $this->mensagem = $mensagem;
        $this->notificacaoContato = $notificacaoContato;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'. $this->notificacaoContato);
    }

    public function broadcastAs()
    {
        return 'EnviarMensagem';
    }

    public function broadcastWith()
    {
        return [
            'mensagem' => $this->mensagem
        ];    
    }
}
