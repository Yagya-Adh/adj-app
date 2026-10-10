<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

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
        return [
            'title' => 'New contact received',
            'message' => 'A new contact has been submitted.',
            'contact_id' => $this->contact->getKey(),
            'created_at' => now()->toISOString(),
        ];
    }
}