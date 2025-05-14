@extends('layouts.main')
@section('konten')
    <section class="pt-20 md:pt-32 min-h-screen">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
                    <h2 class="text-xl font-bold mb-10">Lengkapi Data Siswa di Bawah Ini:</h2>

                    <form action="{{ route('assessment.store') }}" method="POST" class="font-poppins">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-footer">Nama Siswa <span class="text-[#ff0000]">*</span></label>
                            <input type="text" name="name"
                                class="w-full p-2 border rounded @error('name') border-red-500 @enderror" required
                                placeholder="Nama Lengkap Siswa" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Asal Sekolah <span class="text-[#ff0000]">*</span></label>
                            <input type="text" name="sekolah"
                                class="w-full p-2 border rounded @error('sekolah') border-red-500 @enderror" required
                                placeholder="Asal Sekolah" value="{{ old('sekolah') }}">
                            @error('sekolah')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Provinsi <span class="text-red-500">*</span></label>
                            <select name="provinsi" id="provinsi"
                                class="w-full p-2 border rounded cursor-pointer select2 @error('provinsi') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $id => $name)
                                    <option value="{{ $id }}" {{ old('provinsi') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Kota/Kabupaten <span class="text-red-500">*</span></label>
                            <select name="kota" id="kota"
                                class="w-full p-2 border rounded cursor-pointer select2 @error('kota') border-red-500 @enderror"
                                required {{ old('kota') ? '' : 'disabled' }}>
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                            @error('kota')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Nomor Whatsapp Orang Tua <span
                                    class="text-[#ff0000]">*</span></label>
                            <input type="text" name="nomor_whatsapp_orang_tua"
                                class="w-full p-2 border rounded @error('nomor_whatsapp_orang_tua') border-red-500 @enderror"
                                required placeholder="Nomor Orang Tua" value="{{ old('nomor_whatsapp_orang_tua') }}">
                            @error('nomor_whatsapp_orang_tua')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Nomor Whatsapp Guru <span
                                    class="text-[#ff0000]">*</span></label>
                            <input type="text" name="nomor_whatsapp_guru"
                                class="w-full p-2 border rounded @error('nomor_whatsapp_guru') border-red-500 @enderror"
                                required placeholder="Nomor Whatsapp Guru" value="{{ old('nomor_whatsapp_guru') }}">
                            @error('nomor_whatsapp_guru')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-footer">Email Guru <span class="text-[#ff0000]">*</span></label>
                            <input type="email" name="email_guru"
                                class="w-full p-2 border rounded @error('email_guru') border-red-500 @enderror" required
                                placeholder="Email Guru" value="{{ old('email_guru') }}">
                            @error('email_guru')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 untuk provinsi
                $('#provinsi').select2({
                    placeholder: "Pilih Provinsi",
                    allowClear: true,
                    width: '100%'
                });

                // Inisialisasi Select2 untuk kota/kabupaten
                $('#kota').select2({
                    placeholder: "Pilih Kota/Kabupaten",
                    allowClear: true,
                    width: '100%'
                });

                // Event handler untuk perubahan provinsi
                $('#provinsi').on('change', function() {
                    var provinceId = $(this).val();
                    if (provinceId) {
                        $.ajax({
                            url: "{{ url('api/cities') }}/" + provinceId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#kota').empty();
                                $('#kota').append(
                                    '<option value="">Pilih Kota/Kabupaten</option>');
                                $.each(data, function(key, value) {
                                    $('#kota').append('<option value="' + value
                                        .id + '">' + value.name + '</option>');
                                });
                                $('#kota').prop('disabled', false).trigger('change');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                $('#kota').empty();
                                $('#kota').prop('disabled', true).trigger('change');
                            }
                        });
                    } else {
                        $('#kota').empty();
                        $('#kota').prop('disabled', true).trigger('change');
                    }
                });

                // Jika ada nilai kota yang tersimpan (old value)
                @if (old('provinsi') && old('kota'))
                    var provinceId = "{{ old('provinsi') }}";
                    var cityId = "{{ old('kota') }}";

                    $.ajax({
                        url: "{{ url('api/cities') }}/" + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kota').empty();
                            $('#kota').append('<option value="">Pilih Kota/Kabupaten</option>');
                            $.each(data, function(key, value) {
                                var selected = value.id == cityId ? 'selected' : '';
                                $('#kota').append('<option value="' + value.id + '" ' +
                                    selected + '>' + value.name + '</option>');
                            });
                            $('#kota').prop('disabled', false).trigger('change');
                        }
                    });
                @endif
            });
        </script>
    @endpush
@endsection
