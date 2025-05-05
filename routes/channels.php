<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('organization.group.{organization_id}', function ($user, $organization_id) {
    return $user->organization_id == (int) $organization_id;
}, ['guards' => ['organization']]);
