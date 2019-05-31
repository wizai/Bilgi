<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Film;
use App\Http\Requests\FilmStoreRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Film::with(["users"])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmStoreRequest $request)
    {
        $film = Film::create($request->all());
        $usersIds = $request->input('users');
        $usersIds = explode(',', $usersIds);
        $film->users()->attach($usersIds);
        return response()->json($film, 201);

       /* $film = Film::create($request->all());
        return response()->json($film, 201);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($film)
    {
        return Film::find($film);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilmStoreRequest  $request, $id)
    {
       /* $film = Film::findOrFail($id);
        $film->title = $request->title;
        $film->post_content = $request->post_content;
        $film->email = $request->email;
        $film->author = $request->author;
        $film->save();

        return new FilmResource($film);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$film = Film::findOrFail($id);
        $film->delete();

        return new PostResource($film);*/
    }
}
