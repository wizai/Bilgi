<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\User;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hobby::with(["users"])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hobby = Hobby::create($request->all());
        $user = User::find($request->get('user_ids'));
        $hobby->users()->attach($user);
        $hobby->save();
        return response()->json($hobby, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hobby)
    {
        return Hobby::find($hobby);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hobby = Hobby::find($id);
        $user = User::find($request->get('user_ids'));
        $hobby->users()->attach($user);
        $hobby->save();
        return response()->json($hobby, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hobby::delete($id);
    }
}
