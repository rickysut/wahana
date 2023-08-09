<?php

namespace App\Providers;

use App\MoonShine\Resources\DestinationResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Models\MoonshineUserRole;
use App\MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\ClientResource;
use App\MoonShine\Resources\EventResource;
use App\MoonShine\Resources\SolutionResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\MediaResource;
use App\MoonShine\Resources\ContactResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
                MenuItem::make('Dashboard', fn() => route('moonshine.index'))->icon('heroicons.outline.computer-desktop') ,
                
                MenuItem::make('moonshine::ui.resource.solution', new SolutionResource())
                        ->translatable()
                        ->icon('heroicons.outline.bolt'),
                    
                    
                MenuItem::make('moonshine::ui.resource.news', new NewsResource())
                    ->translatable()
                    ->icon('heroicons.puzzle-piece'),
                
                MenuItem::make('moonshine::ui.resource.event', new EventResource())
                    ->translatable()
                    ->icon('heroicons.calendar-days'),
                
                MenuItem::make('moonshine::ui.resource.client', new ClientResource())
                    ->translatable()
                    ->icon('heroicons.outline.users'),
                    
                MenuItem::make('moonshine::ui.resource.media', new MediaResource())
                    ->translatable()
                    ->icon('heroicons.outline.folder-open'),
                    
                MenuItem::make('moonshine::ui.resource.contact', new ContactResource())
                    ->translatable()
                    ->icon('heroicons.phone'),
                    
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users')
                    ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),


        ]);
    }
}
