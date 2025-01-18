<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('response', function ($user, $id) {
    dd($user);
    return (int) $user->id === (int) $id;
});
