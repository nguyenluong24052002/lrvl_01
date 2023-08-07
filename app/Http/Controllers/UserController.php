<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;

use App\Models\User;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::get()
        ]);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(SaveUserRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['type'] = User::TYPE['admin'];

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }

        User::create($inputs);
        return to_route('user.index');
    }

    public function edit($id)
    {
        return view('users.form',[
            'user' => User::find($id)
        ]);
    }

    public function update(SaveUserRequest $request, $id)
    {
        $inputs = array_filter($request->all());
        if ($request->pasword){
            $inputs['pasword'] = bcrypt($request->pasword);
        }

        if ($request->avatar) {
            $inputs['avatar'] = Storage::disk('public')->put('media', $request->avatar);
        }


        User::find($id)->update($inputs);
        return to_route('user.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user.index');
    }
}
