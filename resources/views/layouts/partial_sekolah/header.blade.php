<header id="header" class="navbar bg-base-100 shadow-lg sticky top-0 z-50 backdrop-blur-sm bg-opacity-95">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16">
                    </path>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#staf">Staf & Guru</a></li>
                <li><a href="#ekstrakurikuler">Ekstrakurikuler</a></li>
                <li><a href="#prestasi">Prestasi</a></li>
                <li><a href="#events">Event</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost text-xl font-bold">
            @isset($cover->logo_smp)
                <img src="{{ asset('storage/' . $cover->logo_smp) }}" alt="Logo Sekolah" style="height: 24px;">
            @endisset
            {{ $cover->judul_smp ?? 'ini judul' }}
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="#beranda" class="hover:text-primary transition-colors">Beranda</a></li>
            <li><a href="#staf" class="hover:text-primary transition-colors">Staf & Guru</a></li>
            <li><a href="#ekstrakurikuler" class="hover:text-primary transition-colors">Ekstrakurikuler</a></li>
            <li><a href="#prestasi" class="hover:text-primary transition-colors">Prestasi</a></li>
            <li><a href="#events">Event</a></li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
    </div>
</header>
