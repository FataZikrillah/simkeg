<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> </title>
    <style>
        @page {
            margin: 0;
            size: auto;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            color: #1a1a1a;
            line-height: 1.4;
            margin: 0;
            padding: 1.5cm;
            /* Menjaga konten tetap memiliki margin dari tepi kertas */
        }

        /* Kop Surat Styles */
        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 2px;
            margin-bottom: 2px;
            text-align: center;
            position: relative;
        }

        .kop-header-line {
            border-bottom: 1px solid #000;
            margin-bottom: 20px;
        }

        .instansi-name {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        .instansi-sub {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
        }

        .instansi-address {
            font-size: 10pt;
            font-style: italic;
            margin: 5px 0;
        }

        /* Document Title */
        .doc-title {
            text-align: center;
            margin: 25px 0;
        }

        .doc-title h2 {
            text-decoration: underline;
            margin-bottom: 5px;
            font-size: 14pt;
        }

        .doc-title p {
            margin: 0;
            font-size: 11pt;
        }

        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            font-size: 10pt;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Status & Priority tags */
        .status-badge {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 8pt;
        }

        /* Signature Styles */
        .signature-wrapper {
            margin-top: 40px;
            width: 100%;
        }

        .signature-box {
            float: right;
            width: 250px;
            text-align: center;
        }

        .signature-space {
            height: 80px;
        }

        /* Print Fallback UI */
        .no-print {
            background: #fdfdfd;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-print {
            padding: 8px 16px;
            background: #7B3F61;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-back {
            padding: 8px 16px;
            background: #6c757d;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    @if (isset($is_print))
        <div class="no-print">
            <div>
                <span style="font-weight: bold; color: #7B3F61;">SIMKEG | Print Preview</span>
            </div>
            <div>
                <button onclick="window.print()" class="btn-print">
                    🖨️ Cetak Laporan (PDF)
                </button>
                <a href="{{ route('pimpinan.kegiatan.index') }}" class="btn-back">
                    🔙 Kembali
                </a>
            </div>
        </div>
    @endif

    <!-- KOP SURAT -->
    <div class="kop-surat">
        <h1 class="instansi-name">Sistem Informasi Manajemen Kegiatan</h1>
        <h2 class="instansi-sub">SIMKEG DIGITAL SOLUTIONS</h2>
        <p class="instansi-address">
            Jl. Raya Perkantoran No. 45, Lantai 4, Jakarta Selatan<br>
            Telp: (021) 1234567 | Website: www.simkeg.com | Email: support@simkeg.com
        </p>
    </div>
    <div class="kop-header-line"></div>

    <!-- JUDUL DOKUMEN -->
    <div class="doc-title">
        <h2>LAPORAN REKAPITULASI KEGIATAN</h2>
        <p>Periode Cetak: {{ now()->format('d F Y') }}</p>
    </div>

    <!-- DAFTAR KEGIATAN -->
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="30%">Nama Kegiatan</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Lokasi</th>
                <th width="15%">Anggaran</th>
                <th width="10%">Status</th>
                <th width="10%">Prioritas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->judul }}</strong><br>
                        <span style="font-size: 9pt; color: #444;">{{ Str::limit($item->deskripsi, 60) }}</span>
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td class="text-right">
                        {{ $item->anggaran->isNotEmpty() ? 'Rp ' . number_format($item->anggaran->sum('nominal'), 0, ',', '.') : '-' }}
                    </td>
                    <td class="text-center status-badge">
                        {{ $item->status }}
                    </td>
                    <td class="text-center">
                        {{ $item->prioritas ?? 'Normal' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data kegiatan ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="signature-wrapper">
        <div class="signature-box">
            <p>Jakarta, {{ now()->format('d F Y') }}</p>
            <p><strong>Pimpinan Organisasi</strong></p>
            <div class="signature-space"></div>
            <p><u>( ......................................... )</u></p>
            <p>NIP. .....................................</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    @if (isset($is_print))
        <script>
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                }, 800);
            }
        </script>
    @endif
</body>

</html>
