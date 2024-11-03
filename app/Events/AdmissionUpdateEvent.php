<?php

namespace App\Events;

use App\Models\User;
use App\Notifications\AdmissionUpdateNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdmissionUpdateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notifications');
    }

    public function broadcastWith()
    {
        return ['message' => $this->message];
    }

    public function sendAdmissionUpdate()
    {
        // Logic to send notifications to users
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new AdmissionUpdateNotification($this->message));
        }
    }
}
