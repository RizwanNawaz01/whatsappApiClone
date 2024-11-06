<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    public $chatroom;
    public $message;

    public function __construct(Chatroom $chatroom, Message $message)
    {
        $this->chatroom = $chatroom;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel("chatroom.{$this->chatroom->id}");
    }
}
