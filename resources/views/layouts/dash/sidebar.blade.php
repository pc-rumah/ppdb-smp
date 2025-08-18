<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                @php
                    $role = Auth::user()->roles->pluck('name')->first(); // Ambil role pertama
                @endphp

                @if (in_array($role, ['master-admin', 'admin', 'ppdb']))
                    <img src="{{ asset('dash/assets/images/logos/logosidebar.webp') }}" width="180"
                        alt="Logo Sidebar" />
                @elseif ($role === 'madrasah')
                    <div class="gruplogo">
                        <img class="logounit"
                            src="{{ $cover?->logo_madrasah ? asset('storage/' . $cover->logo_madrasah) : asset('dash/assets/images/default-logo.webp') }}"
                            width="50" alt="Logo Madrasah" />
                        <h4 style="margin: 0;">Madrasah</h4>
                    </div>
                @elseif ($role === 'pondok')
                    <div class="gruplogo">
                        <img class="logounit"
                            src="{{ $cover?->logo_pondok ? asset('storage/' . $cover->logo_pondok) : asset('dash/assets/images/default-logo.webp') }}"
                            width="50" alt="Logo Pondok" />
                        <h4 style="margin: 0;">Pondok</h4>
                    </div>
                @elseif ($role === 'staff')
                    <div class="gruplogo">
                        <img class="logounit"
                            src="{{ $cover?->logo_smp ? asset('storage/' . $cover->logo_smp) : asset('dash/assets/images/default-logo.webp') }}"
                            width="50" alt="Logo SMP" />
                        <h4 style="margin: 0; font-size: 15px;">SMP Al Mas`udiyyah</h4>
                    </div>
                @endif

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

                @if (Auth::user()->hasRole('master-admin'))
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
                            href="{{ route('programmadrasah.approval') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Program</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('prestasimadrasah*') ? 'active' : '' }}"
                            href="{{ route('prestasimadrasah.approval') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Bagan Prestasi</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('stafmadrasah*') ? 'active' : '' }}"
                            href="{{ route('stafmadrasah.approval') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Staff Madrasah</span>
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

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kontakunit*') ? 'active' : '' }}"
                            href="{{ route('kontakunit.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kontak Madrasah</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('eventmadrasah*') ? 'active' : '' }}"
                            href="{{ route('eventmadrasah.approval') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Acara Mendatang</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumumanmadrasah*') ? 'active' : '' }}"
                            href="{{ route('pengumumanmadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman Madrasah</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MENU</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kelolausers*') ? 'active' : '' }}"
                            href="{{ route('kelolausers.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kelola User</span>
                        </a>
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
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('event') || Request::is('event/*') ? 'active' : '' }}"
                            href="{{ route('event.index') }}" aria-expanded="false">
                            <span><i class="ti ti-article"></i></span>
                            <span class="hide-menu">Acara Mendatang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumuman') || Request::is('pengumuman/*') ? 'active' : '' }}"
                            href="{{ route('pengumuman.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasAnyRole(['ppdb', 'admin']))
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
                        <a class="sidebar-link {{ Request::is('jadwal*') ? 'active' : '' }}"
                            href="{{ route('jadwal.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Buka/Tutup</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sakit*') ? 'active' : '' }}"
                            href="{{ route('sakit.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Riwayat Sakit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('saudara*') ? 'active' : '' }}"
                            href="{{ route('saudara.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Saudara</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('assetbukti*') ? 'active' : '' }}"
                            href="{{ route('assetbukti.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Asset Bukti</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasAnyRole(['madrasah', 'admin']))
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
                        <a class="sidebar-link {{ Request::is('stafmadrasah*') ? 'active' : '' }}"
                            href="{{ route('stafmadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Staff Madrasah</span>
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

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kontakunit*') ? 'active' : '' }}"
                            href="{{ route('kontakunit.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kontak Madrasah</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('eventmadrasah*') ? 'active' : '' }}"
                            href="{{ route('eventmadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Acara Mendatang</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumumanmadrasah*') ? 'active' : '' }}"
                            href="{{ route('pengumumanmadrasah.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman Madrasah</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasAnyRole(['staff', 'admin']))
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
                            <span class="hide-menu">Bagan Cover Smp</span>
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
                            <span class="hide-menu">Staff Smp</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('ekstra*') ? 'active' : '' }}"
                            href="{{ route('ekstra.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Ekstra Smp</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('prestasi*') ? 'active' : '' }}"
                            href="{{ route('prestasi.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Prestasi Smp</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kontakunit*') ? 'active' : '' }}"
                            href="{{ route('kontakunit.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kontak Smp</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('sosmedsmp*') ? 'active' : '' }}"
                            href="{{ route('sosmedsmp.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Sosial Media Smp</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('eventsmp*') ? 'active' : '' }}"
                            href="{{ route('eventsmp.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Acara Mendatang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumumansmp*') ? 'active' : '' }}"
                            href="{{ route('pengumumansmp.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman Sekolah</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasAnyRole(['pondok', 'admin']))
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
                            <span class="hide-menu">Kegiatan Pondok</span>
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

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('kontakunit*') ? 'active' : '' }}"
                            href="{{ route('kontakunit.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Kontak Pondok</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('eventpondok*') ? 'active' : '' }}"
                            href="{{ route('eventpondok.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Acara Mendatang</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('pengumumanpondok*') ? 'active' : '' }}"
                            href="{{ route('pengumumanpondok.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-article"></i>
                            </span>
                            <span class="hide-menu">Pengumuman Pondok</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>
