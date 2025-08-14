<header class="navbar bg-base-100 fixed top-0 z-50 shadow-md">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="#hero">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#registration">Pendaftaran</a></li>
                <li><a href="#events">Acara</a></li>
                <li><a href="#contact">Kontak</a></li>
                @if (Auth::check())
                    <li class="login"><a href="/dashboard">Dashboard</a></li>
                @else
                    <li class="login"><a href="/login">Login</a></li>
                @endif
            </ul>
        </div>
        <a class="btn btn-ghost text-xl">
            @isset($cover->logo_madrasah)
                <img src="{{ asset('storage/' . $cover->logo_madrasah) }}" alt="logo madrasah" class="h-10">
            @endisset
            @isset($cover->logo_smp)
                <img src="{{ asset('storage/' . $cover->logo_smp) }}" alt="Logo Sekolah" class="h-10">
            @endisset
            @isset($cover->logo_pondok)
                <img src="{{ asset('storage/' . $cover->logo_pondok) }}" alt="logo madrasah" class="h-10">
            @endisset
        </a>
    </div>
    <div class="navbar-end hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="#hero">Beranda</a></li>
            <li><a href="#about">Tentang</a></li>
            <li><a href="#registration">Pendaftaran</a></li>
            <li><a href="#events">Acara</a></li>
            <li><a href="#contact">Kontak</a></li>
            @if (Auth::check())
                <li class="login"><a href="/dashboard">Dashboard</a></li>
            @else
                <li class="login"><a href="/login">Login</a></li>
            @endif
        </ul>
    </div>
</header>
