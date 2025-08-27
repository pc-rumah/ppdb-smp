@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <div class="row">

                            <div class="container">
                                <h1 class="mb-4">Rekapitulasi Pendaftar</h1>

                                <form method="GET" action="{{ route('rekap.pendaftar.index') }}" class="row g-3 mb-4">
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ $start }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ $end }}">
                                    </div>
                                    <div class="col-md-3 align-self-end">
                                        <button class="btn btn-primary">Terapkan</button>
                                    </div>
                                    @if ($start && $end)
                                        <div class="col-md-3 align-self-end text-end">
                                            <a href="{{ route('rekap.pendaftar.download', ['start_date' => $start, 'end_date' => $end, 'format' => 'xlsx']) }}"
                                                class="btn btn-success">
                                                Download XLSX
                                            </a>
                                            <a href="{{ route('rekap.pendaftar.download', ['start_date' => $start, 'end_date' => $end, 'format' => 'csv']) }}"
                                                class="btn btn-outline-success ms-2">
                                                CSV
                                            </a>
                                        </div>
                                    @endif
                                </form>

                                @if ($start && $end)
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h5>Ringkasan ({{ $start }} s/d {{ $end }})</h5>
                                            <p class="mb-1"><strong>Total pendaftar:</strong> {{ $total }}</p>
                                            <p class="mb-1">
                                                <strong>Per Status:</strong>
                                                @foreach ($perStatus as $st => $j)
                                                    <span class="badge bg-secondary">{{ $st }}:
                                                        {{ $j }}</span>
                                                @endforeach
                                            </p>
                                            <p class="mb-1">
                                                <strong>Per Jenis Kelamin:</strong>
                                                @foreach ($perGender as $g => $j)
                                                    <span class="badge bg-info">{{ $g }}:
                                                        {{ $j }}</span>
                                                @endforeach
                                            </p>
                                            <p class="mb-1">
                                                <strong>Per Jenis Pendaftaran:</strong>
                                                @foreach ($perJenisDaftar as $jp => $j)
                                                    <span class="badge bg-warning text-dark">{{ $jp }}:
                                                        {{ $j }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-3">Top 10 Asal Kabupaten/Kota</h6>
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Kabupaten/Kota</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($topKabupaten as $row)
                                                            <tr>
                                                                <td>{{ $row->kabupaten_kota ?? '-' }}</td>
                                                                <td>{{ $row->jml }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            @include('layouts.allerror')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
