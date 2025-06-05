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
</body>
