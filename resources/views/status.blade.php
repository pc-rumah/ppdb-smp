<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-diterima {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-menunggu {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .registration-type {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .search-container {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center gap-4">
                <a href="/ppdb" class="btn btn-ghost btn-sm">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                    <span class="text-gray-600">Kembali</span>
                </a>
                <h1 class="text-xl font-semibold text-gray-900">Status Pendaftaran PPDB</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="stats-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $total }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-filter text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Diterima</p>
                        <p class="text-2xl font-bold text-green-600"> {{ $diterima }} </p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Menunggu</p>
                        <p class="text-2xl font-bold text-yellow-600"> {{ $menunggu }} </p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <div class="stats-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                        <p class="text-2xl font-bold text-red-600"> {{ $ditolak }} </p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-times text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="search-container">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari berdasarkan nama atau asal sekolah..."
                            class="input input-bordered w-full pl-10 bg-gray-50">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <select class="select select-bordered w-full bg-gray-50">
                        <option>Semua Status</option>
                        <option>Diterima</option>
                        <option>Menunggu</option>
                        <option>Ditolak</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">NO. PENDAFTARAN</th>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA LENGKAP</th>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">JENIS PENDAFTARAN
                            </th>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">ASAL SEKOLAH</th>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">TANGGAL DAFTAR</th>
                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="font-medium text-gray-900"> {{ $item->no_pendaftaran }} </td>
                                <td class="text-gray-900">{{ $item->nama_lengkap }}</td>
                                <td><span class="registration-type">{{ $item->jenis_pendaftaran }}</span></td>
                                <td class="text-gray-600">{{ $item->asal_sekolah }}</td>
                                <td class="text-gray-600">15/1/2025</td>
                                <td>
                                    @if ($item->status == 'diterima')
                                        <span class="status-badge status-diterima">
                                            <i class="fas fa-check"></i>
                                            Diterima
                                        </span>
                                    @elseif ($item->status == 'menunggu')
                                        <span class="status-badge status-menunggu">
                                            <i class="fas fa-clock"></i>
                                            Menunggu
                                        </span>
                                    @else
                                        <span class="status-badge status-ditolak">
                                            <i class="fas fa-times"></i>
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
