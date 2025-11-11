<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Hasil Tes Gaya Belajar</title>
    <style>
        @page {
            margin: 12mm;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #111;
        }

        h1 {
            font-size: 20px;
            margin: 0 0 8px;
        }

        h2 {
            font-size: 16px;
            margin: 0 0 8px;
        }

        .container {
            padding: 0;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .small {
            font-size: 11px;
            color: #666;
        }

        .avatar {
            width: 110px;
            height: auto;
            max-height: 130px;
            border-radius: 8px;
            border: 1px solid #ccc;
            display: block;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 8px;
        }

        .label {
            color: #6b7280;
        }

        .value {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info td {
            vertical-align: middle;
            padding: 0;
        }
        .info .photo-cell { width: 120px; padding-right: 12px; }

        .scores {
            width: 100%;
        }

        .scores td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
        }

        .bar-wrap {
            width: 100%;
            height: 10px;
            background: #e5e7eb;
            border-radius: 4px;
        }

        .bar {
            height: 10px;
            border-radius: 4px;
        }

        .bar.visual {
            background: #93c5fd;
        }

        .bar.auditori {
            background: #86efac;
        }

        .bar.kinestetik {
            background: #fde68a;
        }

        .bar.readwrite {
            background: #d8b4fe;
        }

        .tip-list {
            margin: 0;
            padding-left: 16px;
        }

        .minat-table td {
            width: 50%;
            padding: 6px 10px;
        }

        .identity { margin-top: 6px; }
        .identity td { padding: 3px 6px; }
        .footer {
            margin-top: 8px;
        }
    </style>
    @php $total = max(array_sum($skor), 1); @endphp
    @php
        $foto = session('registrasi.foto_avatar_path') ?: session('registrasi.foto_path');
        $isUrl = $foto ? \Illuminate\Support\Str::startsWith($foto, ['http://', 'https://']) : false;
        $fotoUrl = $foto ? ($isUrl ? $foto : asset('storage/' . $foto)) : null;
        $minatTitles = [
            'Saya lebih sering belajar menggunakan' => 'Perangkat sering digunakan',
            'Saya paling nyaman belajar di' => 'Tempat paling nyaman',
            'Tipe materi yang paling saya sukai' => 'Tipe materi favorit',
            'Cara belajar yang paling cocok untuk saya' => 'Cara belajar cocok',
            'Tujuan utama belajar saya saat ini' => 'Tujuan belajar saat ini',
            'Metode evaluasi yang paling saya sukai' => 'Metode evaluasi disukai',
            'Durasi sesi belajar ideal saya' => 'Durasi ideal',
            'Saya lebih mudah memahami materi ketika' => 'Kondisi memudahkan',
            'Waktu belajar yang paling tersedia untuk saya' => 'Waktu tersedia',
            'Media pencatatan favorit saya' => 'Media pencatatan favorit',
        ];
        $minats = collect(session('minat_belajar') ?? [])
            ->take(10)
            ->values();
    @endphp
</head>

<body>
    <div class="container">
        <table class="info" cellspacing="0" cellpadding="0">
            <tr>
                <td class="photo-cell">
                    @if ($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="Foto Siswa" class="avatar">
                    @endif
                </td>
                <td>
                    <h1>Hasil Tes Gaya Belajar</h1>
                    <div class="small">Tanggal: {{ now()->format('d/m/Y H:i') }}</div>
                    <div class="mb-2"><span class="label">Nama:</span> <span
                            class="value">{{ session('registrasi.name') }}</span></div>
                    <table class="identity" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><span class="label">Jenjang:</span> <span
                                    class="value">{{ session('registrasi.jenjang') }}</span></td>
                            <td><span class="label">Sekolah:</span> <span
                                    class="value">{{ session('registrasi.sekolah') }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="label">Provinsi:</span> <span
                                    class="value">{{ session('registrasi.provinsi') }}</span></td>
                            <td><span class="label">Kota/Kabupaten:</span> <span
                                    class="value">{{ session('registrasi.kota') }}</span></td>
                        </tr>
                        @if (session('registrasi.nisn'))
                            <tr>
                                <td colspan="2"><span class="label">NISN:</span> <span
                                        class="value">{{ session('registrasi.nisn') }}</span></td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>

        <div class="card mb-3">
            <h2>Gaya Belajar Anda</h2>
            <div><strong>Gaya Belajar:</strong> {{ ucfirst($hasil->gaya_belajar) }}</div>
        </div>

        <div class="card mb-3">
            <h2>Skor Detail</h2>
            <table class="scores" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <div class="label">Visual ({{ $skor['visual'] }})</div>
                        <div class="bar-wrap">
                            <div class="bar visual" style="width: {{ round(($skor['visual'] / $total) * 100) }}%"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">Auditori ({{ $skor['auditori'] }})</div>
                        <div class="bar-wrap">
                            <div class="bar auditori" style="width: {{ round(($skor['auditori'] / $total) * 100) }}%">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="label">Kinestetik ({{ $skor['kinestetik'] }})</div>
                        <div class="bar-wrap">
                            <div class="bar kinestetik"
                                style="width: {{ round(($skor['kinestetik'] / $total) * 100) }}%"></div>
                        </div>
                    </td>
                    <td>
                        <div class="label">Read/Write ({{ $skor['readwrite'] }})</div>
                        <div class="bar-wrap">
                            <div class="bar readwrite" style="width: {{ round(($skor['readwrite'] / $total) * 100) }}%">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card mb-3">
            <h2>Tips Singkat</h2>
            @if ($hasil->gaya_belajar == 'visual')
                <ul class="tip-list">
                    <li>Gunakan mind map atau diagram.</li>
                    <li>Buat catatan berwarna dan simbol.</li>
                    <li>Manfaatkan video pembelajaran.</li>
                </ul>
            @elseif ($hasil->gaya_belajar == 'auditori')
                <ul class="tip-list">
                    <li>Rekam dan dengarkan materi.</li>
                    <li>Diskusikan materi dengan teman.</li>
                    <li>Baca materi dengan suara keras.</li>
                </ul>
            @elseif ($hasil->gaya_belajar == 'kinestetik')
                <ul class="tip-list">
                    <li>Lakukan eksperimen atau praktik.</li>
                    <li>Gunakan model atau prototipe.</li>
                    <li>Belajar sambil bergerak.</li>
                </ul>
            @else
                <ul class="tip-list">
                    <li>Buat catatan terstruktur.</li>
                    <li>Baca dan tulis ulang materi.</li>
                    <li>Buat rangkuman.</li>
                </ul>
            @endif
        </div>

        @if ($minats->isNotEmpty())
            <div class="card">
                <h2>Ringkasan Minat Belajar</h2>
                <table class="minat-table" cellspacing="0" cellpadding="0">
                    @for ($i = 0; $i < $minats->count(); $i += 2)
                        <tr>
                            @for ($j = 0; $j < 2; $j++)
                                @php $idx = $i + $j; @endphp
                                <td>
                                    @if ($idx < $minats->count())
                                        @php
                                            $m = $minats[$idx];
                                            $original = $m['pertanyaan'] ?? '';
                                            $clean = trim(rtrim($original, '.:…'));
                                            $title = $clean;
                                            foreach ($minatTitles as $needle => $friendly) {
                                                if (\Illuminate\Support\Str::contains($clean, $needle)) {
                                                    $title = $friendly;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <span class="label">{{ $title }}:</span>
                                        <span class="value">{{ $m['label'] }}</span>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </table>
            </div>
        @endif

    </div>
</body>

</html>
