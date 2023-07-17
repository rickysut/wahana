<?php

namespace App\Policies;

use App\Models\News;
use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;


class NewsPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, News $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, News $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, News $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, News $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, News $model)
    {
        return true;
    }
}
