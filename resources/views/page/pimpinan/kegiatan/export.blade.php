<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #7B3F61;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #7B3F61;
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
            color: #7B3F61;
            font-weight: bold;
        }

        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-disetujui {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Kegiatan</h1>
        <p>Sistem Informasi Manajemen Kegiatan (Simkeg)</p>
        <p>Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Kegiatan</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Lokasi</th>
                <th width="15%">Anggaran</th>
                <th width="15%">Status</th>
                <th width="10%">Prioritas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->judul }}</strong><br>
                        <small>{{ Str::limit($item->deskripsi, 50) }}</small>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->anggaran ? 'Rp ' . number_format($item->anggaran->nominal, 0, ',', '.') : '-' }}</td>
                    <td>
                        <span class="status status-{{ $item->status }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ ucfirst($item->prioritas ?? 'Normal') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak secara otomatis oleh sistem pada {{ now()->format('d F Y') }}</p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Pimpinan Simkeg</strong></p>
    </div>
</body>

</html>
