<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('assessment');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Simpan data ke database atau lakukan validasi
        return redirect()->back()->with('success', 'Jawaban Anda berhasil dikirim!');
    }
}
