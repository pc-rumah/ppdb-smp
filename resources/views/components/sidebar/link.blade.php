@props(['href' => '#', 'icon' => 'ti ti-article', 'active' => false])
<li class="sidebar-item">
    <a class="sidebar-link {{ $active ? 'active' : '' }}" href="{{ $href }}" aria-expanded="false">
        <span><i class="{{ $icon }}"></i></span>
        <span class="hide-menu">{{ $slot }}</span>
    </a>
</li>
