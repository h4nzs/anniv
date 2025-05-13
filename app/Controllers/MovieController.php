<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class MovieController extends Controller
{
    public function index()
    {
        return view('movie');
    }

    public function search()
    {
        $mood = $this->request->getPost('mood');
        $apiKey = 'd3986ef7532acb0bf147c0782f4c7364';

        $genreMap = [
            'bahagia' => 35, // Comedy
            'sedih'   => 18, // Drama
            'romantis'=> 10749, // Romance
            'takut'   => 27, // Horror
            'semangat'=> 28  // Action
        ];

        $genreId = $genreMap[$mood] ?? 35;

        $client = \Config\Services::curlrequest();
        $response = $client->get("https://api.themoviedb.org/3/discover/movie?api_key={$apiKey}&with_genres={$genreId}");

        $data = json_decode($response->getBody(), true);

        return $this->response->setJSON($data['results'] ?? []);
    }
}
