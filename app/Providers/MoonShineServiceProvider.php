<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Models\MoonshineUserRole;
use App\MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
                MenuItem::make('Dashboard', fn() => route('moonshine.index'))->icon('heroicons.outline.computer-desktop') ,

                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users')
                    ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),


        ]);
    }
}
