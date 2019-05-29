<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    private $nbNews = 100;
    private $nbMovies = 20;

    public function show($letter)
    {

        return $this->getArticle($letter);

    }


    public function getArticle($letter)
    {
        $req = @file_get_contents($this->getNewsApiUrl($letter));
        if ($req) {
            $jsonDecoded = json_decode($req);
            $result = array_filter($jsonDecoded->articles, function ($object) use ($letter) {
                if ($object->title[0] === $letter) {
                    return true;
                }
                return false;
            });
            if (count($result) <= 0) {
                return $this->getMovies($letter);
            }
            $randomIndex = array_rand($result, 1);
            $json = json_encode($result[$randomIndex]);
            return new Response($json, 200, array('Content-Type' => 'application/json'));

        }
        abort(404);

    }

    public function getMovies($letter)
    {
        // Get total pages before get JSON file
        $reqTotalPages = @file_get_contents($this->getMoviesApiUrl($letter));
        $totalPages = json_decode($reqTotalPages)->total_pages;

        $page = rand(0, $totalPages);
        $req = @file_get_contents($this->getMoviesApiUrl($letter, $page));
        if ($req) {
            $jsonDecoded = json_decode($req);
            $result = array_filter($jsonDecoded->results, function ($object) use ($letter) {
                if ($object->title[0] === $letter) {
                    return true;
                }
                return false;
            });
            if (count($result) <= 0) {
                return $this->getMovies($letter);
            }
            $randomIndex = array_rand($result, 1);
            $json = json_encode($result[$randomIndex]);
            return new Response($json, 200, array('Content-Type' => 'application/json'));

        }

        abort(404);
    }


    /***************************** NEWS API *****************************/
    private function getNewsApiUrl($letter)
    {
        $apiKey = '18be628568e0469bbe75365552c3154f';
        $apiOptions = 'q=' . $letter . '&pageSize=' . $this->nbNews;
        return 'https://newsapi.org/v2/everything?' . $apiOptions . '&apiKey=' . $apiKey;
    }

    /***************************** THEMOVIEDB API *****************************/
    private function getMoviesApiUrl($letter, $page = 1)
    {
        $apiKey = 'c799aadd76087ed621e2bb3c7efe569e';
        return 'https://api.themoviedb.org/3/search/movie?api_key=' . $apiKey . '&query=' . $letter . '&page=' . $page;
    }

}
