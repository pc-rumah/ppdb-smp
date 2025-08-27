@props(['role', 'cover' => null])

@php
    $map = config('sidebar.logos');
    $logo = $map[$role] ?? null;
@endphp

@if (!$logo || $logo['type'] === 'static')
    <img src="{{ asset($logo['src'] ?? 'dash/assets/images/logos/logosidebar.webp') }}" width="180"
        alt="Logo Sidebar" />
@elseif($logo['type'] === 'cover')
    @php
        $path = $cover?->{$logo['key']} ? asset('storage/' . $cover->{$logo['key']}) : asset($logo['fallback']);
    @endphp
    <div class="gruplogo">
        <img class="logounit" src="{{ $path }}" width="50" alt="Logo Unit" />
        @if (!empty($logo['label']))
            <h4 style="margin:0; {{ $logo['label_class'] ?? '' }}">{{ $logo['label'] }}</h4>
        @endif
    </div>
@endif
