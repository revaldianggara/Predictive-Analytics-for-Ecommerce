@php
    $main_menu = App\Utils\MenuGenerator::generateMenu();
@endphp

@foreach ($main_menu as $menu)
    @if (!$menu->hasChildren())
        @include('layouts.parts.sidebar_components.admin.nav-item', ['item' => $menu])
    @else
        @include('layouts.parts.sidebar_components.admin.sub_menu', ['item' => $menu])
    @endif
@endforeach
