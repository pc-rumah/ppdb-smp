<!DOCTYPE html>
<html lang="id" data-theme="retro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('formpartial/styles.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
</head>

<body>
    <div class="form-container bg-base-200">
        <div class="form-title">
            <h1 class="text-3xl font-bold">Formulir Pendaftaran Siswa Baru</h1>
            <p class="text-sm mt-2">Silakan isi formulir dengan data yang benar</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

        <script src="{{ asset('formpartial/script.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

        <script>
            new TomSelect('.tom-select', {
                plugins: ['remove_button'],
                placeholder: 'Pilih riwayat penyakit...',
            });
        </script>

        <script>
            const API = {
                provinces: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                regencies: (provId) => `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`,
                districts: (kabId) => `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`,
                villages: (kecId) => `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`,
            };

            const els = {
                prov: document.getElementById('provinsi'),
                kab: document.getElementById('kabupaten'),
                kec: document.getElementById('kecamatan'),
                des: document.getElementById('desa'),

                prov_id: document.getElementById('provinsi_id'),
                kab_id: document.getElementById('kabupaten_id'),
                kec_id: document.getElementById('kecamatan_id'),
                des_id: document.getElementById('desa_id'),

                prov_text: document.getElementById('provinsi_text'),
                kab_text: document.getElementById('kabupaten_text'),
                kec_text: document.getElementById('kecamatan_text'),
                des_text: document.getElementById('desa_text'),
            };

            // Ambil nilai old() untuk preselect (server-side rendered)
            const OLD = {
                prov_id: "{{ old('provinsi_id') }}",
                kab_id: "{{ old('kabupaten_id') }}",
                kec_id: "{{ old('kecamatan_id') }}",
                des_id: "{{ old('desa_id') }}",

                prov_text: "{{ old('provinsi') }}",
                kab_text: "{{ old('kabupaten') }}",
                kec_text: "{{ old('kecamatan') }}",
                des_text: "{{ old('desa') }}",
            };

            function setLoading(select, isLoading) {
                select.disabled = isLoading;
                if (isLoading) {
                    select.innerHTML = `<option value="">Memuat...</option>`;
                }
            }

            function fillOptions(select, data, placeholder = 'Pilih...') {
                const opts = [`<option value="">${placeholder}</option>`]
                    .concat(data.map(d => `<option value="${d.id}">${d.name}</option>`));
                select.innerHTML = opts.join('');
                select.disabled = false;
            }

            function syncHidden(select, idInput, textInput) {
                const selected = select.options[select.selectedIndex];
                idInput.value = select.value || '';
                textInput.value = selected ? selected.text : '';
            }

            async function fetchJSON(url) {
                const res = await fetch(url, {
                    cache: 'no-store'
                });
                if (!res.ok) throw new Error(`Gagal fetch ${url}`);
                return res.json();
            }

            async function loadProvinces() {
                setLoading(els.prov, true);
                const data = await fetchJSON(API.provinces);
                fillOptions(els.prov, data, 'Pilih provinsi');
                if (OLD.prov_id) {
                    els.prov.value = OLD.prov_id;
                    syncHidden(els.prov, els.prov_id, els.prov_text);
                    await loadRegencies(OLD.prov_id, true);
                }
            }

            async function loadRegencies(provId, restoring = false) {
                els.kab.disabled = true;
                els.kec.disabled = true;
                els.des.disabled = true;
                els.kab.innerHTML = '<option value="">Pilih kabupaten/kota</option>';
                els.kec.innerHTML = '<option value="">Pilih kecamatan</option>';
                els.des.innerHTML = '<option value="">Pilih desa/kelurahan</option>';

                if (!provId) return;

                setLoading(els.kab, true);
                const data = await fetchJSON(API.regencies(provId));
                fillOptions(els.kab, data, 'Pilih kabupaten/kota');

                if (restoring && OLD.kab_id) {
                    els.kab.value = OLD.kab_id;
                    syncHidden(els.kab, els.kab_id, els.kab_text);
                    await loadDistricts(OLD.kab_id, true);
                }
            }

            async function loadDistricts(kabId, restoring = false) {
                els.kec.disabled = true;
                els.des.disabled = true;
                els.kec.innerHTML = '<option value="">Pilih kecamatan</option>';
                els.des.innerHTML = '<option value="">Pilih desa/kelurahan</option>';

                if (!kabId) return;

                setLoading(els.kec, true);
                const data = await fetchJSON(API.districts(kabId));
                fillOptions(els.kec, data, 'Pilih kecamatan');

                if (restoring && OLD.kec_id) {
                    els.kec.value = OLD.kec_id;
                    syncHidden(els.kec, els.kecamatan_id, els.kec_text);
                    await loadVillages(OLD.kec_id, true);
                }
            }

            async function loadVillages(kecId, restoring = false) {
                els.des.disabled = true;
                els.des.innerHTML = '<option value="">Pilih desa/kelurahan</option>';
                if (!kecId) return;

                setLoading(els.des, true);
                const data = await fetchJSON(API.villages(kecId));
                fillOptions(els.des, data, 'Pilih desa/kelurahan');

                if (restoring && OLD.des_id) {
                    els.des.value = OLD.des_id;
                    syncHidden(els.des, els.des_id, els.des_text);
                }
            }

            // Events
            els.prov.addEventListener('change', async (e) => {
                syncHidden(els.prov, els.prov_id, els.prov_text);
                await loadRegencies(e.target.value);
                // reset turunannya
                els.kab_id.value = '';
                els.kab_text.value = '';
                els.kec_id.value = '';
                els.kec_text.value = '';
                els.des_id.value = '';
                els.des_text.value = '';
            });

            els.kab.addEventListener('change', async (e) => {
                syncHidden(els.kab, els.kab_id, els.kab_text);
                await loadDistricts(e.target.value);
                els.kec_id.value = '';
                els.kec_text.value = '';
                els.des_id.value = '';
                els.des_text.value = '';
            });

            els.kec.addEventListener('change', async (e) => {
                syncHidden(els.kec, els.kec_id, els.kec_text);
                await loadVillages(e.target.value);
                els.des_id.value = '';
                els.des_text.value = '';
            });

            els.des.addEventListener('change', () => {
                syncHidden(els.des, els.des_id, els.des_text);
            });

            // Init
            loadProvinces().catch(() => {
                // fallback kalau API gagal
                els.prov.innerHTML = '<option value="">Gagal memuat provinsi</option>';
                els.prov.disabled = true;
            });
        </script>
</body>
