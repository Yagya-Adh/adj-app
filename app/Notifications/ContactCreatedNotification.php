<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ContactCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(public Contact $contact)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $model = Str::headline(class_basename($this->contact));

        return [
            'title' => "New {$model} Received",
            'message' => "A new {$model} has been submitted by {$this->contact->name}.",
            'contact_id' => $this->contact->getKey(),
            'created_at' => now()->toISOString(),
        ];
    }
}