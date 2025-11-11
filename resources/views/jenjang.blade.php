@extends('layouts.main')
@section('konten')
    <section class="pt-20 md:pt-32 min-h-screen">
        <div class="container mx-auto p-6">
            <div class="flex justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full">
                    <h2 class="text-xl font-bold mb-6">Pilih Jenjang Pendidikan</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('assessment.jenjang.store') }}" method="POST" class="font-poppins">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-footer mb-2">Jenjang <span class="text-red-500">*</span></label>
                            <select name="jenjang" id="jenjang" class="w-full p-2 border rounded" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>

                        <div id="tingkatanSdWrapper" class="mb-4" style="display: none;">
                            <label class="block text-footer mb-2">Tingkatan SD <span class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="tingkatan_sd" value="rendah"
                                        {{ old('tingkatan_sd') == 'rendah' ? 'checked' : '' }}>
                                    <span>Rendah (Kelas 1–3)</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="tingkatan_sd" value="tinggi"
                                        {{ old('tingkatan_sd') == 'tinggi' ? 'checked' : '' }}>
                                    <span>Tinggi (Kelas 4–6)</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-center items-center self-center space-x-4">
                            <button type="submit"
                                class="w-full md:w-1/2 py-2 bg-headerbanner text-white font-poppins font-bold uppercase rounded-full hover:bg-footer cursor-pointer">
                                Lanjutkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jenjangSelect = document.getElementById('jenjang');
                const tingkatanWrapper = document.getElementById('tingkatanSdWrapper');

                function toggleTingkatan() {
                    if (jenjangSelect.value === 'SD') {
                        tingkatanWrapper.style.display = 'block';
                    } else {
                        tingkatanWrapper.style.display = 'none';
                        // clear selection
                        const radios = tingkatanWrapper.querySelectorAll('input[type="radio"]');
                        radios.forEach(r => r.checked = false);
                    }
                }

                jenjangSelect.addEventListener('change', toggleTingkatan);
                toggleTingkatan(); // initial
            });
        </script>
    @endpush
@endsection