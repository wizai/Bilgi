<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        var_dump($request);
        if ($request->hobby){
            foreach ($request->hobby as $item) {
                $user->Hobbies()->create([
                    'title' => $item
                ]);
            }
        }
        if ($request->file){
            $path = $request->file('avatar')->store('avatars');
            $user->Avatar()->create([
                'name'      => asset('/storage/'.$path),
            ]);
        }
        if(!$token = auth()->attempt($request->only(['email', 'password'])))
        {
            return abort(401);
        }
        return (new UserResource($user))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        if(!$token = auth()->attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'errors' => [
                    'email' => ['There is something wrong! We could not verify details']
                ]], 422);
        }
        return (new UserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }
    public function logout()
    {
        auth()->logout();
    }

}
