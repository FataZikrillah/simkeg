<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan - {{ $kegiatan->judul }}</title>
    <style>
        @page {
            margin: 50px 25px;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
        }
        
        .logo {
            height: 60px;
            margin-bottom: 10px;
        }
        
        .title {
            color: #3b82f6;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: #64748b;
            font-size: 14px;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            background-color: #f8fafc;
            padding: 8px 12px;
            border-left: 4px solid #3b82f6;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            min-width: 120px;
            color: #64748b;
        }
        
        .info-value {
            color: #1e293b;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .table th {
            background-color: #f1f5f9;
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #e2e8f0;
            font-weight: bold;
            color: #475569;
        }
        
        .table td {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            color: #334155;
        }
        
        .signature-section {
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            text-align: center;
        }
        
        .signature-box {
            padding-top: 60px;
            position: relative;
        }
        
        .signature-line {
            border-top: 1px solid #cbd5e1;
            width: 80%;
            margin: 0 auto;
            position: absolute;
            top: 40px;
            left: 10%;
        }
        
        .footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #64748b;
            font-size: 10px;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-high {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="title">Office Admin Management System</div>
        <div class="subtitle">Laporan Resmi Kegiatan</div>
    </div>
    
    <!-- Basic Information -->
    <div class="section">
        <div class="section-title">Informasi Kegiatan</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Judul Kegiatan:</div>
                <div class="info-value">{{ $kegiatan->judul }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal:</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Lokasi:</div>
                <div class="info-value">{{ $kegiatan->lokasi }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status:</div>
                <div class="info-value">
                    <span class="badge {{ $kegiatan->status == 'disetujui' ? 'badge-approved' : 'badge-pending' }}">
                        {{ ucfirst($kegiatan->status) }}
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Prioritas:</div>
                <div class="info-value">
                    <span class="badge {{ $kegiatan->prioritas == 'tinggi' ? 'badge-high' : '' }}">
                        {{ ucfirst($kegiatan->prioritas) }}
                    </span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Penanggung Jawab:</div>
                <div class="info-value">{{ $kegiatan->user->name }}</div>
            </div>
        </div>
    </div>
    
    <!-- Description -->
    <div class="section">
        <div class="section-title">Deskripsi Kegiatan</div>
        <div style="padding: 0 10px;">
            {{ $kegiatan->deskripsi }}
        </div>
    </div>
    
    <!-- Budget -->
    @if($kegiatan->anggaran)
    <div class="section">
        <div class="section-title">Anggaran</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Jumlah</th>
                    <th>Sumber Dana</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rp {{ number_format($kegiatan->anggaran->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $kegiatan->anggaran->sumber_dana }}</td>
                    <td>{{ $kegiatan->anggaran->keterangan }}</td>
                    <td>{{ ucfirst($kegiatan->anggaran->status) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Reports -->
    @if($kegiatan->laporan->count() > 0)
    <div class="section">
        <div class="section-title">Laporan Terkait</div>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Laporan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatan->laporan as $laporan)
                <tr>
                    <td>{{ $laporan->judul }}</td>
                    <td>{{ $laporan->created_at->format('d M Y') }}</td>
                    <td>{{ ucfirst($laporan->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Signatures -->
    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>Penanggung Jawab</div>
            <div style="margin-top: 5px; font-weight: bold;">{{ $kegiatan->user->name }}</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>Mengetahui,</div>
            <div style="margin-top: 5px; font-weight: bold;">Pimpinan</div>
        </div>
        
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>Administrator</div>
            <div style="margin-top: 5px; font-weight: bold;">Admin Sistem</div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <div>Dokumen ini dicetak pada {{ now()->format('d F Y H:i') }}</div>
        <div>Halaman <span class="pageNumber"></span> dari <span class="totalPages"></span></div>
    </div>
    
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("DejaVu Sans");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>