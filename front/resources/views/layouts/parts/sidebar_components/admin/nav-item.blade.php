<li class="nav-main-item">
    <a class="nav-main-link {{ strpos(Route::current()->getName(), $item->data('prefix_route_name')) !== false ? 'active' : '' }}"
        href="{{ $item->url() }}">
        @if ($item->data('icon'))
            <i class="nav-main-link-icon {{ $item->data('icon') }}"></i>
        @endif
        <span class="nav-main-link-name">{{ $item->title }}</span>
    </a>
</li>
