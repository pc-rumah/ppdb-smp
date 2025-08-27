<?php

return [
    // Logo per-roles (simple map)
    'logos' => [
        'master-admin' => ['type' => 'static', 'src' => 'dash/assets/images/logos/logosidebar.webp', 'label' => null],
        'admin'        => ['type' => 'static', 'src' => 'dash/assets/images/logos/logosidebar.webp', 'label' => null],
        'ppdb'         => ['type' => 'static', 'src' => 'dash/assets/images/logos/logosidebar.webp', 'label' => null],
        'madrasah'     => ['type' => 'cover',  'key' => 'logo_madrasah', 'fallback' => 'dash/assets/images/default-logo.webp', 'label' => 'Madrasah'],
        'pondok'       => ['type' => 'cover',  'key' => 'logo_pondok',   'fallback' => 'dash/assets/images/default-logo.webp', 'label' => 'Pondok'],
        'staff'        => ['type' => 'cover',  'key' => 'logo_smp',      'fallback' => 'dash/assets/images/default-logo.webp', 'label' => 'SMP Al Mas`udiyyah', 'label_class' => 'font-size:15px;'],
    ],

    // Groups menu. Muncul jika user punya salah satu role di 'roles'
    'groups' => [
        [
            'title' => 'Home',
            'roles' => ['*'], // semua
            'items' => [
                ['text' => 'Dashboard', 'icon' => 'ti ti-layout-dashboard', 'route' => '/dashboard', 'active' => 'dashboard'],
            ],
        ],

        // === MASTER ADMIN: Madrasah ===
        [
            'title' => 'Manage Unit Madrasah',
            'roles' => ['master-admin'],
            'items' => [
                ['text' => 'Bagan Cover Madrasah', 'icon' => 'ti ti-article', 'route_name' => 'madrasah.create',        'active' => 'madrasah*'],
                ['text' => 'Bagan Program',        'icon' => 'ti ti-article', 'route_name' => 'programmadrasah.approval', 'active' => 'programmadrasah*'],
                ['text' => 'Bagan Prestasi',       'icon' => 'ti ti-article', 'route_name' => 'prestasimadrasah.approval', 'active' => 'prestasimadrasah*'],
                ['text' => 'Staff Madrasah',       'icon' => 'ti ti-article', 'route_name' => 'stafmadrasah.approval',  'active' => 'stafmadrasah*'],
                ['text' => 'Sosial Media',         'icon' => 'ti ti-article', 'route_name' => 'sosmedmadrasah.create',  'active' => 'sosmedmadrasah*'],
                ['text' => 'Kontak Madrasah',      'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',      'active' => 'kontakunit*'],
                ['text' => 'Acara Mendatang',      'icon' => 'ti ti-article', 'route_name' => 'eventmadrasah.approval', 'active' => 'eventmadrasah*'],
                ['text' => 'Pengumuman Madrasah',  'icon' => 'ti ti-article', 'route_name' => 'pengumumanmadrasah.approval', 'active' => 'pengumumanmadrasah*'],
            ],
        ],

        // === MASTER ADMIN: Sekolah ===
        [
            'title' => 'Manage Unit Sekolah',
            'roles' => ['master-admin'],
            'items' => [
                ['text' => 'Bagan Cover Smp',     'icon' => 'ti ti-article', 'route_name' => 'sekolah.create',       'active' => request()->routeIs('sekolah.create') ? 'sekolah.create' : 'sekolah*'],
                ['text' => 'Kelola Kepala Sekolah', 'icon' => 'ti ti-article', 'route_name' => 'kepsek.create',        'active' => 'kepsek*'],
                ['text' => 'Staff Smp',           'icon' => 'ti ti-article', 'route_name' => 'staff.approval',       'active' => 'staff*'],
                ['text' => 'Ekstra Smp',          'icon' => 'ti ti-article', 'route_name' => 'ekstra.approval',      'active' => 'ekstra*'],
                ['text' => 'Prestasi Smp',        'icon' => 'ti ti-article', 'route_name' => 'prestasi.approval',    'active' => 'prestasi*'],
                ['text' => 'Kontak Smp',          'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',    'active' => 'kontakunit*'],
                ['text' => 'Sosial Media Smp',    'icon' => 'ti ti-article', 'route_name' => 'sosmedsmp.create',     'active' => 'sosmedsmp*'],
                ['text' => 'Acara Mendatang',     'icon' => 'ti ti-article', 'route_name' => 'eventsmp.approval',    'active' => 'eventsmp*'],
                ['text' => 'Pengumuman Sekolah',  'icon' => 'ti ti-article', 'route_name' => 'pengumumansmp.approval', 'active' => 'pengumumansmp*'],
            ],
        ],

        // === MASTER ADMIN: Pondok ===
        [
            'title' => 'Manage Unit Pondok',
            'roles' => ['master-admin'],
            'items' => [
                ['text' => 'Bagan Cover Pondok',  'icon' => 'ti ti-article', 'route_name' => 'pondok.create',          'active' => 'pondok*'],
                ['text' => 'Bagan Pengasuh',      'icon' => 'ti ti-article', 'route_name' => 'pengasuh.approval',      'active' => 'pengasuh*'],
                ['text' => 'Bagan Program',       'icon' => 'ti ti-article', 'route_name' => 'programpondok.approval', 'active' => 'programpondok*'],
                ['text' => 'Bagan Item Program',  'icon' => 'ti ti-article', 'route_name' => 'itemprogrampondok.index', 'active' => 'itemprogrampondok*'],
                ['text' => 'Kegiatan Pondok',     'icon' => 'ti ti-article', 'route_name' => 'kegiatanpondok.approval', 'active' => 'kegiatanpondok*'],
                ['text' => 'Sosial Media',        'icon' => 'ti ti-article', 'route_name' => 'sosmedpondok.create',    'active' => 'sosmedpondok*'],
                ['text' => 'Kontak Pondok',       'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',      'active' => 'kontakunit*'],
                ['text' => 'Acara Mendatang',     'icon' => 'ti ti-article', 'route_name' => 'eventpondok.approval',   'active' => 'eventpondok*'],
                ['text' => 'Pengumuman Pondok',   'icon' => 'ti ti-article', 'route_name' => 'pengumumanpondok.approval', 'active' => 'pengumumanpondok*'],
            ],
        ],

        // === ADMIN umum ===
        [
            'title' => 'MENU',
            'roles' => ['admin'],
            'items' => [
                ['text' => 'Kelola User',   'icon' => 'ti ti-article', 'route_name' => 'kelolausers.index', 'active' => 'kelolausers*'],
            ],
        ],
        [
            'title' => 'Konten Web',
            'roles' => ['admin'],
            'items' => [
                ['text' => 'Setting Landing', 'icon' => 'ti ti-article', 'route_name' => 'manage.create',     'active' => 'manage*'],
                ['text' => 'Setting Kontak', 'icon' => 'ti ti-article', 'route_name' => 'kontakweb.create',  'active' => 'kontakweb*'],
                ['text' => 'Acara Mendatang', 'icon' => 'ti ti-article', 'route_name' => 'event.index',       'active' => 'event|event/*'],
                ['text' => 'Pengumuman',     'icon' => 'ti ti-article', 'route_name' => 'pengumuman.index',  'active' => 'pengumuman|pengumuman/*'],
            ],
        ],

        // === PPDB (ppdb atau admin) ===
        [
            'title' => 'PPDB',
            'roles' => ['ppdb', 'admin'],
            'items' => [
                ['text' => 'Rekap',         'icon' => 'ti ti-article', 'route_name' => 'rekap.pendaftar.index', 'active' => 'rekap*'],
                ['text' => 'PPDB',          'icon' => 'ti ti-article', 'route_name' => 'pendaftar.index',       'active' => 'pendaftar*'],
                ['text' => 'Buka/Tutup',    'icon' => 'ti ti-article', 'route_name' => 'jadwal.index',          'active' => 'jadwal*'],
                ['text' => 'Riwayat Sakit', 'icon' => 'ti ti-article', 'route_name' => 'sakit.index',           'active' => 'sakit*'],
                ['text' => 'Saudara',       'icon' => 'ti ti-article', 'route_name' => 'saudara.index',         'active' => 'saudara*'],
                ['text' => 'Asset Bukti',   'icon' => 'ti ti-article', 'route_name' => 'assetbukti.create',     'active' => 'assetbukti*'],
            ],
        ],

        // === MADRASAH (madrasah atau admin) ===
        [
            'title' => 'Manage Unit Madrasah',
            'roles' => ['madrasah', 'admin'],
            'items' => [
                ['text' => 'Bagan Cover Madrasah', 'icon' => 'ti ti-article', 'route_name' => 'madrasah.create',       'active' => 'madrasah*'],
                ['text' => 'Bagan Program',       'icon' => 'ti ti-article', 'route_name' => 'programmadrasah.index', 'active' => 'programmadrasah*'],
                ['text' => 'Bagan Prestasi',      'icon' => 'ti ti-article', 'route_name' => 'prestasimadrasah.index', 'active' => 'prestasimadrasah*'],
                ['text' => 'Staff Madrasah',      'icon' => 'ti ti-article', 'route_name' => 'stafmadrasah.index',    'active' => 'stafmadrasah*'],
                ['text' => 'Sosial Media',        'icon' => 'ti ti-article', 'route_name' => 'sosmedmadrasah.create', 'active' => 'sosmedmadrasah*'],
                ['text' => 'Kontak Madrasah',     'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',     'active' => 'kontakunit*'],
                ['text' => 'Acara Mendatang',     'icon' => 'ti ti-article', 'route_name' => 'eventmadrasah.index',   'active' => 'eventmadrasah*'],
                ['text' => 'Pengumuman Madrasah', 'icon' => 'ti ti-article', 'route_name' => 'pengumumanmadrasah.index', 'active' => 'pengumumanmadrasah*'],
            ],
        ],

        // === STAFF (staff atau admin) ===
        [
            'title' => 'Manage Unit Sekolah',
            'roles' => ['staff', 'admin'],
            'items' => [
                ['text' => 'Bagan Cover Smp',  'icon' => 'ti ti-article', 'route_name' => 'sekolah.create',     'active' => request()->routeIs('sekolah.create') ? 'sekolah.create' : 'sekolah*'],
                ['text' => 'Kelola Kepala Sekolah', 'icon' => 'ti ti-article', 'route_name' => 'kepsek.create',  'active' => 'kepsek*'],
                ['text' => 'Staff Smp',        'icon' => 'ti ti-article', 'route_name' => 'staff.index',        'active' => 'staff*'],
                ['text' => 'Ekstra Smp',       'icon' => 'ti ti-article', 'route_name' => 'ekstra.index',       'active' => 'ekstra*'],
                ['text' => 'Prestasi Smp',     'icon' => 'ti ti-article', 'route_name' => 'prestasi.index',     'active' => 'prestasi*'],
                ['text' => 'Kontak Smp',       'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',  'active' => 'kontakunit*'],
                ['text' => 'Sosial Media Smp', 'icon' => 'ti ti-article', 'route_name' => 'sosmedsmp.create',   'active' => 'sosmedsmp*'],
                ['text' => 'Acara Mendatang',  'icon' => 'ti ti-article', 'route_name' => 'eventsmp.index',     'active' => 'eventsmp*'],
                ['text' => 'Pengumuman Sekolah', 'icon' => 'ti ti-article', 'route_name' => 'pengumumansmp.index', 'active' => 'pengumumansmp*'],
            ],
        ],

        // === PONDOK (pondok atau admin) ===
        [
            'title' => 'Manage Unit Pondok',
            'roles' => ['pondok', 'admin'],
            'items' => [
                ['text' => 'Bagan Cover Pondok', 'icon' => 'ti ti-article', 'route_name' => 'pondok.create',          'active' => 'pondok*'],
                ['text' => 'Bagan Pengasuh',     'icon' => 'ti ti-article', 'route_name' => 'pengasuh.index',         'active' => 'pengasuh*'],
                ['text' => 'Bagan Program',      'icon' => 'ti ti-article', 'route_name' => 'programpondok.index',    'active' => 'programpondok*'],
                ['text' => 'Bagan Item Program', 'icon' => 'ti ti-article', 'route_name' => 'itemprogrampondok.index', 'active' => 'itemprogrampondok*'],
                ['text' => 'Kegiatan Pondok',    'icon' => 'ti ti-article', 'route_name' => 'kegiatanpondok.index',   'active' => 'kegiatanpondok*'],
                ['text' => 'Sosial Media',       'icon' => 'ti ti-article', 'route_name' => 'sosmedpondok.create',    'active' => 'sosmedpondok*'],
                ['text' => 'Kontak Pondok',      'icon' => 'ti ti-article', 'route_name' => 'kontakunit.create',      'active' => 'kontakunit*'],
                ['text' => 'Acara Mendatang',    'icon' => 'ti ti-article', 'route_name' => 'eventpondok.index',      'active' => 'eventpondok*'],
                ['text' => 'Pengumuman Pondok',  'icon' => 'ti ti-article', 'route_name' => 'pengumumanpondok.index', 'active' => 'pengumumanpondok*'],
            ],
        ],
    ],
];
