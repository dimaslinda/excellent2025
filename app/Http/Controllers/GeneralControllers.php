<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Ekskul;
use App\Models\Ebook;
use App\Models\Ecourse;
use App\Models\Gallery;
use App\Models\Webinar;
use App\Models\Bootcamp;
use App\Models\Inhouse;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use GuzzleHttp\Promise;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

class GeneralControllers extends Controller
{
    private function fetchPostsAsync($limit)
    {
        $client = new Client();
        $apiUrl = "https://excellentteam.id/artikel/wp-json/wp/v2/posts";

        $promises = [
            'posts' => $client->getAsync($apiUrl, [
                'verify' => false,
                'auth' => ['dimasbon', 'dongorasta'],
            ])
        ];

        $results = Utils::settle($promises)->wait();

        if (!isset($results['posts']['value'])) {
            return [];
        }

        $posts = json_decode($results['posts']['value']->getBody());
        if (!is_array($posts)) {
            return [];
        }

        return array_slice($posts, 0, $limit);
    }

    public function index()
    {
        $testimoni = Testimoni::with('media')->get();
        $gallery = Gallery::with('media')->where('publish', 1)->orderBy('id', 'desc')->limit(5)->get();

        // Ambil semua data secara async
        $promises = [
            'responselates' => $this->fetchPostsAsync(1),
            'responselimit' => $this->fetchPostsAsync(4),
        ];

        return view('index', [
            'responselates' => $promises['responselates'],
            'responselimit' => $promises['responselimit'],
            'testimoni' => $testimoni,
            'gallery' => $gallery
        ]);
    }

    public function inhouse()
    {
        $testimoni = Testimoni::with('media')->get();
        $inhouse = Inhouse::with('media')
            ->orderByRaw('CASE WHEN publish = 1 THEN 0 ELSE 1 END')
            ->orderBy('id', 'desc')
            ->get();
        return view('inhouse', compact('inhouse', 'testimoni'));
    }

    public function modul()
    {
        $modulAjar = Modul::with('media')->get();
        return view('modul', compact('modulAjar'));
    }

    public function ebook()
    {
        $ebooks = Ebook::with('media')
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ebook', compact('ebooks'));
    }

    public function downloadEbook(Ebook $ebook)
    {
        $media = $ebook->getFirstMedia('ebook_file');

        if (! $media) {
            abort(404);
        }

        $filename = Str::slug($ebook->name) . '.pdf';

        return response()->streamDownload(function () use ($media) {
            echo Storage::disk($media->disk)->get($media->getPath());
        }, $filename, [
            'Content-Type' => $media->mime_type ?? 'application/pdf',
        ]);
    }

    public function webinar()
    {
        $webinar = Webinar::with('media')
            ->orderByRaw('CASE WHEN publish = 1 THEN 0 ELSE 1 END')
            ->orderBy('id', 'desc')
            ->get();
        return view('webinar', compact('webinar'));
    }

    public function ecourse()
    {
        $ecourse = Ecourse::with('media')->get();
        return view('ecourse', compact('ecourse'));
    }

    public function bootcamp()
    {
        $bootcamp = Bootcamp::with('media')->get();
        return view('bootcamp', compact('bootcamp'));
    }

    public function eskul()
    {
        $testimoni = Testimoni::with('media')->get();
        $ekskul = Ekskul::with('media')->orderBy('id', 'desc')->get();
        return view('eskul', compact('ekskul', 'testimoni'));
    }

    public function galeri()
    {
        $gallery = Gallery::with('media')
            ->where('publish', 1)
            ->orderBy('id', 'desc')
            ->paginate(50);
        return view('gallery', compact('gallery'));
    }

    public function registrasi()
    {
        // Pastikan jenjang sudah dipilih sebelum registrasi
        if (!session()->has('assessment_jenjang')) {
            return redirect()->route('assessment.jenjang')
                ->with('error', 'Silakan pilih jenjang terlebih dahulu.');
        }

        $provinces = Province::orderBy('name')->pluck('name', 'code');
        return view('registrasi', compact('provinces'));
    }
}
