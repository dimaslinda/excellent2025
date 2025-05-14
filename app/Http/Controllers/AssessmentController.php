<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\QueryException;

class AssessmentController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah registrasi
        if (!session()->has('registrasi')) {
            return redirect()->route('registrasi')->with('error', 'Silakan lengkapi data registrasi terlebih dahulu');
        }

        return view('assessment');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'provinsi' => 'required|exists:indonesia_provinces,code',
            'kota' => 'required|exists:indonesia_cities,code',
            'nomor_whatsapp_orang_tua' => 'required|string|max:20|regex:/^[0-9]+$/',
            'nomor_whatsapp_guru' => 'required|string|max:20|regex:/^[0-9]+$/',
            'email_guru' => 'required|email|max:255',
        ], [
            'name.required' => 'Nama siswa harus diisi',
            'sekolah.required' => 'Asal sekolah harus diisi',
            'provinsi.required' => 'Provinsi harus dipilih',
            'provinsi.exists' => 'Provinsi yang dipilih tidak valid',
            'kota.required' => 'Kota/Kabupaten harus dipilih',
            'kota.exists' => 'Kota/Kabupaten yang dipilih tidak valid',
            'nomor_whatsapp_orang_tua.required' => 'Nomor WhatsApp orang tua harus diisi',
            'nomor_whatsapp_orang_tua.regex' => 'Nomor WhatsApp orang tua harus berupa angka',
            'nomor_whatsapp_guru.required' => 'Nomor WhatsApp guru harus diisi',
            'nomor_whatsapp_guru.regex' => 'Nomor WhatsApp guru harus berupa angka',
            'email_guru.required' => 'Email guru harus diisi',
            'email_guru.email' => 'Format email guru tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek apakah data sudah ada
        $existingPeserta = Peserta::where('name', $request->name)
            ->where('sekolah', $request->sekolah)
            ->first();

        if ($existingPeserta) {
            // Jika data sudah ada, langsung simpan ke session dan redirect ke assessment
            session([
                'registrasi' => [
                    'id' => $existingPeserta->id,
                    'name' => $existingPeserta->name,
                    'slug' => $existingPeserta->slug,
                    'sekolah' => $existingPeserta->sekolah,
                    'provinsi' => $existingPeserta->provinsi,
                    'kota' => $existingPeserta->kota,
                    'nomor_whatsapp_orang_tua' => $existingPeserta->nomor_whatsapp_orang_tua,
                    'nomor_whatsapp_guru' => $existingPeserta->nomor_whatsapp_guru,
                    'email_guru' => $existingPeserta->email_guru,
                ]
            ]);

            return redirect()->route('assessment')
                ->with('info', 'Data Anda sudah terdaftar sebelumnya. Silakan lanjutkan ke halaman assessment.');
        }

        try {
            // Simpan data ke database
            $peserta = Peserta::create([
                'name' => $request->name,
                'sekolah' => $request->sekolah,
                'provinsi' => Province::where('code', $request->provinsi)->first()->name,
                'kota' => City::where('code', $request->kota)->first()->name,
                'nomor_whatsapp_orang_tua' => $request->nomor_whatsapp_orang_tua,
                'nomor_whatsapp_guru' => $request->nomor_whatsapp_guru,
                'email_guru' => $request->email_guru,
            ]);

            // Simpan data ke session untuk digunakan di halaman assessment
            session([
                'registrasi' => [
                    'id' => $peserta->id,
                    'name' => $peserta->name,
                    'slug' => $peserta->slug,
                    'sekolah' => $peserta->sekolah,
                    'provinsi' => $peserta->provinsi,
                    'kota' => $peserta->kota,
                    'nomor_whatsapp_orang_tua' => $peserta->nomor_whatsapp_orang_tua,
                    'nomor_whatsapp_guru' => $peserta->nomor_whatsapp_guru,
                    'email_guru' => $peserta->email_guru,
                ]
            ]);

            return redirect()->route('assessment');
        } catch (QueryException $e) {
            // Jika error lain
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function hasil()
    {
        // Cek apakah user sudah registrasi
        if (!session()->has('registrasi')) {
            return redirect()->route('registrasi')->with('error', 'Silakan lengkapi data registrasi terlebih dahulu');
        }

        return view('hasil');
    }
}
