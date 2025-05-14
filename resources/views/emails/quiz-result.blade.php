@component('mail::message')
    # Hasil Tes Gaya Belajar

    <div style="background-color: #f7f7f7; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <p style="font-weight: bold; margin-bottom: 15px; font-size: 16px;">Informasi Siswa:</p>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0;"><strong>Nama:</strong></td>
                <td style="padding: 8px 0;">{{ $peserta->name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Asal Sekolah:</strong></td>
                <td style="padding: 8px 0;">{{ $peserta->sekolah }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Provinsi:</strong></td>
                <td style="padding: 8px 0;">{{ $peserta->provinsi }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>Kota/Kabupaten:</strong></td>
                <td style="padding: 8px 0;">{{ $peserta->kota }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0;"><strong>No. WhatsApp Orang Tua:</strong></td>
                <td style="padding: 8px 0;">{{ $peserta->nomor_whatsapp_orang_tua }}</td>
            </tr>
        </table>
    </div>

    <h2 style="color: #2c3e50; text-align: center; margin: 20px 0; padding-bottom: 10px; border-bottom: 2px solid #3498db;">
        Gaya Belajar Dominan: {{ ucfirst($hasil->gaya_belajar) }}
    </h2>

    <div style="margin-bottom: 25px;">
        <h3 style="margin-bottom: 15px;">Detail Skor:</h3>
        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
            <div
                style="background-color: #e74c3c; color: white; padding: 10px; border-radius: 5px; width: 22%; text-align: center;">
                <p style="margin: 0; font-weight: bold;">Visual</p>
                <p style="margin: 5px 0 0; font-size: 18px;">{{ $skor['visual'] }}</p>
            </div>
            <div
                style="background-color: #3498db; color: white; padding: 10px; border-radius: 5px; width: 22%; text-align: center;">
                <p style="margin: 0; font-weight: bold;">Auditori</p>
                <p style="margin: 5px 0 0; font-size: 18px;">{{ $skor['auditori'] }}</p>
            </div>
            <div
                style="background-color: #2ecc71; color: white; padding: 10px; border-radius: 5px; width: 22%; text-align: center;">
                <p style="margin: 0; font-weight: bold;">Kinestetik</p>
                <p style="margin: 5px 0 0; font-size: 18px;">{{ $skor['kinestetik'] }}</p>
            </div>
            <div
                style="background-color: #9b59b6; color: white; padding: 10px; border-radius: 5px; width: 22%; text-align: center;">
                <p style="margin: 0; font-weight: bold;">Read/Write</p>
                <p style="margin: 5px 0 0; font-size: 18px;">{{ $skor['readwrite'] }}</p>
            </div>
        </div>
    </div>

    @component('mail::panel')
        <h3 style="color: #2c3e50; margin-top: 0;">Rekomendasi Belajar</h3>
        <div style="padding: 10px; border-left: 4px solid #3498db;">
            @if ($hasil->gaya_belajar == 'visual')
                Siswa ini memiliki gaya belajar <strong>visual</strong> yang dominan. Sebaiknya berikan materi dengan banyak
                gambar, diagram, dan visualisasi.
            @elseif($hasil->gaya_belajar == 'auditori')
                Siswa ini memiliki gaya belajar <strong>auditori</strong> yang dominan. Sebaiknya berikan materi dengan
                penjelasan lisan, diskusi, dan audio.
            @elseif($hasil->gaya_belajar == 'kinestetik')
                Siswa ini memiliki gaya belajar <strong>kinestetik</strong> yang dominan. Sebaiknya berikan materi dengan
                aktivitas praktik, eksperimen, dan simulasi.
            @else
                Siswa ini memiliki gaya belajar <strong>read/write</strong> yang dominan. Sebaiknya berikan materi dengan banyak
                teks, artikel, dan catatan tertulis.
            @endif
        </div>
    @endcomponent

    <p style="text-align: center; margin-top: 30px; color: #7f8c8d; font-size: 14px;">
        Terima kasih,<br>
        <strong>Tim Excellent 2025</strong>
    </p>
@endcomponent
