<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Hasil Tes Gaya Belajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
        }

        .container {
            background: #fff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 8px;
        }

        h2 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        td {
            padding: 6px 0;
        }

        .score-box {
            display: inline-block;
            background: #3498db;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .panel {
            background: #eaf6fb;
            border-left: 4px solid #3498db;
            padding: 15px;
            margin-bottom: 20px;
        }

        .footer {
            color: #888;
            font-size: 13px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="text-align:center; margin-bottom: 24px;">
            <img src="{{ $message->embed(public_path('img/general/logoemail.png')) }}" alt="Logo Excellent 2025" style="max-width:120px;">
        </div>
        <h2>Hasil Tes Gaya Belajar</h2>
        <table>
            <tr>
                <td><strong>Nama Siswa</strong></td>
                <td>: {{ $peserta->name }}</td>
            </tr>
            <tr>
                <td><strong>Asal Sekolah</strong></td>
                <td>: {{ $peserta->sekolah }}</td>
            </tr>
            <tr>
                <td><strong>Provinsi</strong></td>
                <td>: {{ $peserta->provinsi }}</td>
            </tr>
            <tr>
                <td><strong>Kota/Kabupaten</strong></td>
                <td>: {{ $peserta->kota }}</td>
            </tr>
            <tr>
                <td><strong>No. WhatsApp Orang Tua</strong></td>
                <td>: {{ $peserta->nomor_whatsapp_orang_tua }}</td>
            </tr>
        </table>
        @if (!empty($profil))
            <h3>Profil Siswa</h3>
            <table>
                @foreach ($profil as $p)
                    @php
                        $original = $p['pertanyaan'] ?? '';
                        $clean = trim(rtrim($original, '.:…'));
                    @endphp
                    <tr>
                        <td style="width:55%"><strong>{{ $clean }}</strong></td>
                        <td>: {{ $p['label'] }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        @if (!empty($minat))
            <h3>Minat Belajar</h3>
            <table>
                @php
                    $minatTitles = [
                        'Saya lebih sering belajar menggunakan' => 'Perangkat belajar yang sering digunakan',
                        'Saya paling nyaman belajar di' => 'Tempat belajar paling nyaman',
                        'Tipe materi yang paling saya sukai' => 'Tipe materi favorit',
                        'Cara belajar yang paling cocok untuk saya' => 'Cara belajar yang paling cocok',
                        'Tujuan utama belajar saya saat ini' => 'Tujuan belajar saat ini',
                        'Metode evaluasi yang paling saya sukai' => 'Metode evaluasi yang disukai',
                        'Durasi sesi belajar ideal saya' => 'Durasi sesi belajar ideal',
                        'Saya lebih mudah memahami materi ketika' => 'Kondisi belajar yang memudahkan',
                        'Waktu belajar yang paling tersedia untuk saya' => 'Waktu belajar yang tersedia',
                        'Media pencatatan favorit saya' => 'Media pencatatan favorit',
                    ];
                @endphp
                @foreach ($minat as $m)
                    @php
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
                    <tr>
                        <td style="width:55%"><strong>{{ $title }}</strong></td>
                        <td>: {{ $m['label'] }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <h3>Gaya Belajar Dominan: <span style="color:#3498db">{{ ucfirst($hasil->gaya_belajar) }}</span></h3>
        <div>
            <span class="score-box">Visual: {{ $skor['visual'] }}</span>
            <span class="score-box" style="background:#e67e22;">Auditori: {{ $skor['auditori'] }}</span>
            <span class="score-box" style="background:#2ecc71;">Kinestetik: {{ $skor['kinestetik'] }}</span>
            <span class="score-box" style="background:#9b59b6;">Read/Write: {{ $skor['readwrite'] }}</span>
        </div>
        <div class="panel">
            <strong>Rekomendasi Belajar:</strong><br>
            @if ($hasil->gaya_belajar == 'visual')
                Siswa ini memiliki gaya belajar <b>visual</b> yang dominan. Sebaiknya berikan materi dengan banyak
                gambar, diagram, dan visualisasi.
            @elseif($hasil->gaya_belajar == 'auditori')
                Siswa ini memiliki gaya belajar <b>auditori</b> yang dominan. Sebaiknya berikan materi dengan penjelasan
                lisan, diskusi, dan audio.
            @elseif($hasil->gaya_belajar == 'kinestetik')
                Siswa ini memiliki gaya belajar <b>kinestetik</b> yang dominan. Sebaiknya berikan materi dengan
                aktivitas praktik, eksperimen, dan simulasi.
            @else
                Siswa ini memiliki gaya belajar <b>read/write</b> yang dominan. Sebaiknya berikan materi dengan banyak
                teks, artikel, dan catatan tertulis.
            @endif
        </div>
        <div class="footer">
            Terima kasih,<br>
            <b>Tim Excellent 2025</b>
        </div>
    </div>
</body>

</html>
