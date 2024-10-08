<?php

use Illuminate\Support\Facades\Broadcast;

// Contoh channel broadcast
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
