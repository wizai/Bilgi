<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function show(){
        $req = @file_get_contents('https://newsapi.org/v2/top-headlines?country=us&apiKey=18be628568e0469bbe75365552c3154f');
        if($req){
            $jsonDecoded = json_decode($req);
            if($jsonDecoded->status == 'ok'){
                $json = json_encode($jsonDecoded);
                return new Response($json, 200, array('Content-Type' => 'application/json'));
            }
        }
        abort(404);
    }
}
