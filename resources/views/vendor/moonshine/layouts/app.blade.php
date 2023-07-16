<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{}">
    <head>
        @include('moonshine::layouts.shared.head')

        {!! app(\MoonShine\Utilities\AssetManager::class)->css() !!}

        @yield('after-styles')

        @stack('styles')

        {!! app(\MoonShine\Utilities\AssetManager::class)->js() !!}

        @yield('after-scripts')

        <style>
            [x-cloak] { display: none !important; }
        </style>

        <script>
            const translates = @js(__('moonshine::ui'));
        </script>
    </head>
    <style>
        .layout-page {
            margin-top: 22px;
        }
        .layout-menu .menu-inner {
            margin-top: 28px;
        }
    </style>
    <body x-cloak x-data="{ minimizedMenu: $persist(false).as('minimizedMenu'), asideMenuOpen: false }">
        <div class="layout-wrapper" :class="minimizedMenu && 'layout-wrapper-short'">
            @section('sidebar')
                @include('moonshine::layouts.shared.sidebar')
            @show

            <div class="layout-page">
                @include('moonshine::layouts.shared.flash')

                @section('header')
                    @include('moonshine::layouts.shared.header')
                @show

                <main class="layout-content">
                    @yield('content')
                </main>

                @section('footer')
                    @include('moonshine::layouts.shared.footer')
                @show
            </div>
        </div>


        @stack('scripts')
    </body>
</html>
