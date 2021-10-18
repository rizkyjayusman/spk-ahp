<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct()
    {
    }

    public function getUser(Request $request)
    {
        $user = User::orderBy('id', 'desc');
        if(isset($request->role_id)) {
            $user->where('role_id', $request->role_id);
        }
        return $user->get();
    }

    public function save($request = [])
    {
        $user = new User;
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->role_id = $request['role'];
        $user->password = Hash::make($request['password']);   
        return $user->save();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, $request = [])
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->role_id = $request['role'];
        $user->password = $request['password'];
        return $user->update();
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }

    public function getTotalUser() {
        return  User::all()->count();
    }
}
