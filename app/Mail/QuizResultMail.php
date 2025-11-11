<?php

namespace App\Mail;

use App\Models\QuizHasil;
use App\Models\Peserta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hasil;
    public $peserta;
    public $skor;
    public $minat;

    public function __construct($hasil, $peserta, $skor, $minat = [])
    {
        $this->hasil = $hasil;
        $this->peserta = $peserta;
        $this->skor = $skor;
        $this->minat = $minat;
    }

    public function build()
    {
        return $this->subject('Hasil Tes Gaya Belajar')
            ->view('emails.quiz-result-custom')
            ->with([
                'hasil' => $this->hasil,
                'peserta' => $this->peserta,
                'skor' => $this->skor,
                'minat' => $this->minat,
            ]);
    }
}
