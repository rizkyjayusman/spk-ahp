<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Services\ProductService;
use App\Services\UserService;
use App\Traits\ResponseBuilder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseBuilder;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('pages.users.index');
    }

    public function add()
    {
        return view('pages.users.edit');
    }

    public function addUser(UserRequest $request) 
    {
        
        $user = $this->userService->save($request->validated());
        return redirect('/users');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('pages.users.edit', [
            'user' => $user,
        ]);
    }

    public function editUser($id, UpdateUserRequest $request) 
    {
        $user = $this->userService->update($id, $request->validated());
        return redirect('/users');
    }
}
