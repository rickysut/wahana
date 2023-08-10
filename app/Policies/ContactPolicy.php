<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\Contact;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Contact $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Contact $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Contact $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Contact $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Contact $model)
    {
        return true;
    }
}
