<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Ecourse;
use App\Models\Modul;
use App\Models\Webinar;
use GuzzleHttp\Client;
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
        return view('index', [
            'responselates' => $this->fetchPosts(1),
            'responselimit' => $this->fetchPosts(4),
        ]);
    }

    public function inhouse()
    {
        return view('inhouse');
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
        return view('eskul');
    }

    public function galeri()
    {
        return view('gallery');
    }

    public function registrasi()
    {
        return view('registrasi');
    }
}
