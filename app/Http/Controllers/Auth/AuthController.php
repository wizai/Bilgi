<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hobby){
            foreach (json_decode($request->hobby) as $item) {
                $user->Hobbies()->create([
                    'title' => $item
                ]);
            }
        }
        if ($request->avatar){
            $path  = $request->file('avatar')->store('avatars', ['disk' => 'public']);
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

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));

        if ($request->hobby){
            DB::table('hobbies')->where('user_id', $id)->delete();
            foreach (json_decode($request->hobby) as $item) {
                $user->Hobbies()->create([
                    'title' => $item
                ]);
            }
        }
        if ($request->avatar){
//            DB::table('avatars')->where('user_id', $id)->delete();
//            Storage::disk('public')->delete('avatars/Ac3L4ioN86EJht9NbtoZbINyQWbVQape4QshqoO2.jpeg');
            $path  = $request->file('avatar')->store('avatars', ['disk' => 'public']);
            $user->Avatar()->create([
                'name'      => asset('/storage/'.$path),
            ]);
        }
        $user->save();
    }

    public function logout()
    {
        auth()->logout();
    }

}
