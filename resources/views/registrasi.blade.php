@extends('layouts.main')
@section('konten')
    <section class="pt-20 md:pt-32 min-h-screen">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
                    <h2 class="text-xl font-bold mb-10">Lengkapi Data Siswa di Bawah Ini:</h2>

                    <form action="#" method="POST" class="font-poppins">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-footer">Nama Siswa <span class="text-[#ff0000]">*</span></label>
                            <input type="text" name="nama_siswa" class="w-full p-2 border rounded" required
                                placeholder="Nama Lengkap Siswa">
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Asal Sekolah <span class="text-[#ff0000]">*</span></label>
                            <input type="text" name="asal_sekolah" class="w-full p-2 border rounded" required
                                placeholder="Asal Sekolah">
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Provinsi <span class="text-red-500">*</span></label>
                            <select name="provinsi" id="provinsi" class="w-full p-2 border rounded cursor-pointer"
                                required>
                                <option value="">Pilih Provinsi</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Kota/Kabupaten <span class="text-red-500">*</span></label>
                            <select name="kota_kabupaten" id="kota_kabupaten"
                                class="w-full p-2 border rounded cursor-pointer" required disabled>
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Nomor Whatsapp Orang Tua <span
                                    class="text-[#ff0000]">*</span></label>
                            <input type="text" name="nomor_whatsapp_orang_tua" class="w-full p-2 border rounded" required
                                placeholder="Nomor Orang Tua">
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Nomor Whatsapp Guru <span
                                    class="text-[#ff0000]">*</span></label>
                            <input type="text" name="nomor_whatsapp_guru" class="w-full p-2 border rounded" required
                                placeholder="Nomor Whatsapp Guru">
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Email Guru <span class="text-[#ff0000]">*</span></label>
                            <input type="email" name="email_guru" class="w-full p-2 border rounded" required
                                placeholder="Email Guru">
                        </div>

                        <div class="flex flex-col md:flex-row justify-center items-center self-center space-x-4">
                            <button type="submit"
                                class="w-full md:w-1/2 py-2 bg-headerbanner text-white font-poppins font-bold uppercase rounded-full hover:bg-footer cursor-pointer">
                                Mulai Asesmen
                            </button>
                            <p class="text-sm font-semibold mt-4 text-[#FF0000]">*Pastikan seluruh data terisi dengan benar.
                            </p>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection
@section('kaki')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let dataKotaKabupaten = {
                "Jawa Barat": ["Bandung", "Bogor", "Bekasi"],
                "Jawa Tengah": ["Semarang", "Solo", "Magelang"],
                "Jawa Timur": ["Surabaya", "Malang", "Kediri"]
            };

            $('#provinsi').change(function() {
                let provinsiTerpilih = $(this).val();
                let kotaDropdown = $('#kota_kabupaten');

                kotaDropdown.empty().append('<option value="">Pilih Kota/Kabupaten</option>');
                if (provinsiTerpilih) {
                    dataKotaKabupaten[provinsiTerpilih].forEach(function(kota) {
                        kotaDropdown.append(`<option value="${kota}">${kota}</option>`);
                    });
                    kotaDropdown.prop('disabled', false);
                } else {
                    kotaDropdown.prop('disabled', true);
                }
            });
        });
    </script>
@endsection
