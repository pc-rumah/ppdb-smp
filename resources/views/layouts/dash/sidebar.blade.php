<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                <img src="{{ asset('dash/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MENU</span>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Konten Web</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('manage*') ? 'active' : '' }}"
                            href="{{ route('manage.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Setting Landing</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kontakweb*') ? 'active' : '' }}"
                            href="{{ route('kontakweb.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Setting Kontak</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('staff*') ? 'active' : '' }}"
                            href="{{ route('staff.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Staff</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('event*') ? 'active' : '' }}"
                            href="{{ route('event.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Event</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumuman*') ? 'active' : '' }}"
                            href="{{ route('pengumuman.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman</span>
                        </a>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('galeri*') ? 'active' : '' }}"
                            href="{{ route('galeri.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Galeri</span>
                        </a>
                    </li> --}}
                @endif

                @if (Auth::user()->hasRole('ppdb'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">PPDB</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pendaftar*') ? 'active' : '' }}"
                            href="{{ route('pendaftar.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">PPDB</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sakit*') ? 'active' : '' }}"
                            href="{{ route('sakit.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-circle"></i>
                            </span>
                            <span class="hide-menu">Riwayat Sakit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('saudara*') ? 'active' : '' }}"
                            href="{{ route('saudara.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-circle"></i>
                            </span>
                            <span class="hide-menu">Saudara</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('madrasah'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Manage Unit Madrasah</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('madrasah*') ? 'active' : '' }}"
                            href="{{ route('madrasah.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Cover Madrasah</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('programmadrasah*') ? 'active' : '' }}"
                            href="{{ route('programmadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Program</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('prestasimadrasah*') ? 'active' : '' }}"
                            href="{{ route('prestasimadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Prestasi</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sosmedmadrasah*') ? 'active' : '' }}"
                            href="{{ route('sosmedmadrasah.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Sosial Media</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('staff'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Manage Unit Sekolah</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->routeIs('sekolah.create') ? 'active' : '' }}"
                            href="{{ route('sekolah.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Cover Sekolah</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kepsek*') ? 'active' : '' }}"
                            href="{{ route('kepsek.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kelola Kepala Sekolah</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('staff*') ? 'active' : '' }}"
                            href="{{ route('staff.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Staff</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('ekstra*') ? 'active' : '' }}"
                            href="{{ route('ekstra.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('prestasi*') ? 'active' : '' }}"
                            href="{{ route('prestasi.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Prestasi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sosmedsmp*') ? 'active' : '' }}"
                            href="{{ route('sosmedsmp.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Sosial Media</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('pondok'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Manage Unit Pondok</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pondok*') ? 'active' : '' }}"
                            href="{{ route('pondok.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Cover Pondok</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengasuh*') ? 'active' : '' }}"
                            href="{{ route('pengasuh.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Pengasuh</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('programpondok*') ? 'active' : '' }}"
                            href="{{ route('programpondok.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Program</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('itemprogrampondok*') ? 'active' : '' }}"
                            href="{{ route('itemprogrampondok.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Item Program</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kegiatanpondok*') ? 'active' : '' }}"
                            href="{{ route('kegiatanpondok.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kegiatan</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sosmedpondok*') ? 'active' : '' }}"
                            href="{{ route('sosmedpondok.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Sosial Media</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
