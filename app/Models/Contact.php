<?php

namespace App\Models;

use App\Models\User;
use App\Notifications\ContactCreatedNotification;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];

    protected static function booted(): void
    {
        static::created(function (Contact $contact) {
            User::query()
                // ->where('role', 'admin')
                ->each(function (User $admin) use ($contact) {
                    $admin->notify(
                        new ContactCreatedNotification($contact)
                    );
                });
        });
    }
}