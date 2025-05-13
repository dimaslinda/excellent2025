<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Ekskul;
use GuzzleHttp\Client;
use App\Models\Ecourse;
use App\Models\Gallery;
use App\Models\Webinar;
use App\Models\Bootcamp;
use App\Models\Inhouse;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class GeneralControllers extends Controller
{
    private function fetchPosts($limit)
    {
        $client = new Client();
        $apiUrl = "https://excellentteam.id/artikel/wp-json/wp/v2/posts";

        $response = $client->request('GET', $apiUrl, [
            'verify' => false,
            'auth' => ['dimasbon', 'dongorasta'],
        ]);

        return array_slice(json_decode($response->getBody()), 0, $limit);
    }


    public function index()
    {
        $testimoni = Testimoni::with('media')->get();
        $gallery = Gallery::with('media')->where('publish', 1)->orderBy('id', 'desc')->get();
        return view('index', [
            'responselates' => $this->fetchPosts(1),
            'responselimit' => $this->fetchPosts(4),
            'testimoni' => $testimoni,
            'gallery' => $gallery
        ]);
    }

    public function inhouse()
    {
        $inhouse = Inhouse::with('media')
            ->orderByRaw('CASE WHEN publish = 1 THEN 0 ELSE 1 END')
            ->orderBy('id', 'desc')
            ->get();
        return view('inhouse', compact('inhouse'));
    }

    public function modul()
    {
        $modulAjar = Modul::with('media')->get();
        return view('modul', compact('modulAjar'));
    }

    public function webinar()
    {
        $webinar = Webinar::with('media')->get();
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
        $ekskul = Ekskul::with('media')->orderBy('id', 'desc')->get();
        return view('eskul', compact('ekskul'));
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
        return view('registrasi');
    }
}
