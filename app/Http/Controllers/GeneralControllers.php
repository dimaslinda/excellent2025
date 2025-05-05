<?php

namespace App\Http\Controllers;

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
        return view('modul');
    }

    public function webinar()
    {
        return view('webinar');
    }

    public function ecourse()
    {
        return view('ecourse');
    }
}
