<li
    class="nav-main-item {{ strpos(Route::current()->getName(), $item->data('prefix_route_name')) !== false ? 'open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false"
        href="#">
        <i class="nav-main-link-icon {{ $item->data('icon') }}"></i>
        <span class="nav-main-link-name">{{ $item->title }}</span>
    </a>
    <ul class="nav-main-submenu">
        @foreach ($item->children() as $children)
            @if ($children->hasChildren())
                @include('layouts.parts.sidebar_components.admin.sub_menu', [
                    'item' => $children,
                ])
            @else
                @include('layouts.parts.sidebar_components.admin.nav-item', ['item' => $children])
            @endif
        @endforeach
    </ul>
</li>
