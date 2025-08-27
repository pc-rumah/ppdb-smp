<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                @php $role = Auth::user()->roles->pluck('name')->first(); @endphp
                <x-sidebar.logo :role="$role" :cover="$cover" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                @php
                    $groups = config('sidebar.groups');
                    $user = Auth::user();
                    $visibleGroups = collect($groups)->filter(function ($g) use ($user) {
                        // '*' = semua bisa lihat; selain itu cek any role
                        if (in_array('*', $g['roles'] ?? [])) {
                            return true;
                        }
                        return $user->hasAnyRole($g['roles'] ?? []);
                    });
                @endphp

                @foreach ($visibleGroups as $group)
                    <x-sidebar.section :title="$group['title']" />

                    @foreach ($group['items'] as $item)
                        @php
                            $activePattern = $item['active'] ?? '';
                            $isActive = Str::contains($activePattern, '|')
                                ? collect(explode('|', $activePattern))->some(fn($p) => Request::is(trim($p)))
                                : Request::is($activePattern);
                            $href = $item['route_name'] ?? null ? route($item['route_name']) : $item['route'] ?? '#';
                        @endphp

                        <x-sidebar.link :href="$href" :icon="$item['icon']" :active="$isActive">
                            {{ $item['text'] }}
                        </x-sidebar.link>
                    @endforeach
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
