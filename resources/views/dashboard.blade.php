<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dash/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('dash/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        .gambarPreview {
            max-width: 200px;
            display: block;
            margin-bottom: 10px;
        }

        .logounit {
            margin: 10px 0 0 20px;
        }

        .gruplogo {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.dash.sidebar')

        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.dash.header')
            <!--  Header End -->
            <div class="container-fluid">
                @if (Request::is('dashboard'))
                    <h2>Selamat Datang {{ auth()->user()->name }}</h2>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('dash/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dash/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dash/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dash/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('dash/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('dash/assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(el) {
                    // Tambahkan efek fade out
                    el.classList.remove('show');
                    el.classList.add('fade');
                    // Hapus elemen dari DOM setelah 500ms
                    setTimeout(() => el.remove(), 500);
                });
            }, 5000); // 5 detik
        });

        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');

            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.add('fade');
                    alert.classList.add('show');

                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';

                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const jenisPendaftaran = document.getElementById('jenis_pendaftaran');
            const buktiPembayaranGroup = document.getElementById('bukti_pembayaran_group');
            const buktiPembayaranInput = document.getElementById('bukti_pembayaran');

            function toggleBuktiPembayaran() {
                if (jenisPendaftaran.value === 'online') {
                    buktiPembayaranGroup.classList.remove('d-none');
                    buktiPembayaranInput.required = true;
                } else {
                    buktiPembayaranGroup.classList.add('d-none');
                    buktiPembayaranInput.required = false;
                }
            }

            jenisPendaftaran.addEventListener('change', toggleBuktiPembayaran);

            toggleBuktiPembayaran();
        });

        const penyakitSelect = document.getElementById('penyakit');
        if (penyakitSelect) {
            new TomSelect("#penyakit", {
                plugins: ['remove_button'],
                create: false,
                maxItems: null,
                placeholder: "Pilih penyakit...",
                render: {
                    option: function(data, escape) {
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    item: function(data, escape) {
                        return '<div>' + escape(data.text) + '</div>';
                    }
                }
            });
        }

        let currentPage = 1;
        let isLoading = false;
        let hasMore = true;
        let searchQuery = '';

        function loadIcons(page = 1) {
            if (isLoading || !hasMore) return;
            isLoading = true;

            fetch(`/icons?page=${page}&perPage=100&q=${encodeURIComponent(searchQuery)}`)
                .then(res => res.json())
                .then(data => {
                    const iconContainer = document.getElementById('iconList');

                    if (page === 1) iconContainer.innerHTML = '';

                    data.icons.forEach(icon => {
                        const col = document.createElement('div');
                        col.classList.add('col', 'text-center');
                        col.dataset.icon = icon;
                        col.style.cursor = 'pointer';
                        col.innerHTML = `<i class="${icon}" style="font-size: 1.5rem;"></i>`;
                        col.addEventListener('click', () => {
                            document.getElementById('iconInput').value = icon;
                            document.getElementById('iconPreview').className = icon;
                            bootstrap.Modal.getInstance(document.getElementById('iconPickerModal'))
                                .hide();
                        });
                        iconContainer.appendChild(col);
                    });

                    hasMore = data.hasMore;
                    currentPage = data.nextPage;
                    isLoading = false;
                });
        }

        // Scroll detection
        document.addEventListener('DOMContentLoaded', () => {
            const modalBody = document.querySelector('#iconPickerModal .modal-body');
            modalBody.addEventListener('scroll', () => {
                if (modalBody.scrollTop + modalBody.clientHeight >= modalBody.scrollHeight - 100) {
                    loadIcons(currentPage);
                }
            });

            document.getElementById('iconSearch').addEventListener('input', () => {
                searchQuery = document.getElementById('iconSearch').value.trim();
                currentPage = 1;
                hasMore = true;
                loadIcons(currentPage);
            });

            document.getElementById('iconPickerModal').addEventListener('shown.bs.modal', () => {
                document.getElementById('iconList').innerHTML = '';
                document.getElementById('iconSearch').value = '';
                searchQuery = '';
                currentPage = 1;
                hasMore = true;
                loadIcons();
            });
        });

        const waktuRadio = document.getElementById('waktuRadio');
        const selesaiRadio = document.getElementById('selesaiRadio');
        const inputWaktu = document.getElementById('inputWaktu');
        const inputSelesai = document.getElementById('inputSelesai');

        function toggleInput() {
            if (waktuRadio.checked) {
                inputWaktu.classList.remove('d-none');
                inputSelesai.classList.add('d-none');
            } else {
                inputWaktu.classList.add('d-none');
                inputSelesai.classList.remove('d-none');
            }
        }

        waktuRadio.addEventListener('change', toggleInput);
        selesaiRadio.addEventListener('change', toggleInput);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let provinsiSelect = document.getElementById("provinsi");
            let kabupatenSelect = document.getElementById("kabupaten");
            let kecamatanSelect = document.getElementById("kecamatan");
            let desaSelect = document.getElementById("desa");

            // Load Provinsi
            fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                .then(res => res.json())
                .then(data => {
                    data.forEach(prov => {
                        let opt = document.createElement("option");
                        opt.value = prov.id;
                        opt.textContent = prov.name;
                        provinsiSelect.appendChild(opt);
                    });
                });

            // Event Provinsi -> Kabupaten
            provinsiSelect.addEventListener("change", function() {
                let id = this.value;
                document.getElementById("provinsi_id").value = id;
                document.getElementById("provinsi_text").value = this.options[this.selectedIndex].text;

                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                kabupatenSelect.disabled = true;
                kecamatanSelect.disabled = true;
                desaSelect.disabled = true;

                if (!id) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`)
                    .then(res => res.json())
                    .then(data => {
                        kabupatenSelect.disabled = false;
                        data.forEach(kab => {
                            let opt = document.createElement("option");
                            opt.value = kab.id;
                            opt.textContent = kab.name;
                            kabupatenSelect.appendChild(opt);
                        });
                    });
            });

            // Event Kabupaten -> Kecamatan
            kabupatenSelect.addEventListener("change", function() {
                let id = this.value;
                document.getElementById("kabupaten_id").value = id;
                document.getElementById("kabupaten_text").value = this.options[this.selectedIndex].text;

                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                kecamatanSelect.disabled = true;
                desaSelect.disabled = true;

                if (!id) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${id}.json`)
                    .then(res => res.json())
                    .then(data => {
                        kecamatanSelect.disabled = false;
                        data.forEach(kec => {
                            let opt = document.createElement("option");
                            opt.value = kec.id;
                            opt.textContent = kec.name;
                            kecamatanSelect.appendChild(opt);
                        });
                    });
            });

            // Event Kecamatan -> Desa
            kecamatanSelect.addEventListener("change", function() {
                let id = this.value;
                document.getElementById("kecamatan_id").value = id;
                document.getElementById("kecamatan_text").value = this.options[this.selectedIndex].text;

                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                desaSelect.disabled = true;

                if (!id) return;

                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${id}.json`)
                    .then(res => res.json())
                    .then(data => {
                        desaSelect.disabled = false;
                        data.forEach(des => {
                            let opt = document.createElement("option");
                            opt.value = des.id;
                            opt.textContent = des.name;
                            desaSelect.appendChild(opt);
                        });
                    });
            });

            // Event Desa -> Hidden field
            desaSelect.addEventListener("change", function() {
                document.getElementById("desa_id").value = this.value;
                document.getElementById("desa_text").value = this.options[this.selectedIndex].text;
            });
        });
    </script>


</body>

</html>
