<?php

namespace App\Http\Controllers\v1\Api\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getUser($request);

        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            if(Auth::user()->role_id == 1) {
                return view('pages.users.components.action', ['row' => $row]);
            } else {
                return null;
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function store(UserRequest $userRequest)
    {
        $user = $this->userService->save($userRequest);
        
        return Response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function show($userId)
    {
        $user = $this->userService->getUserById($userId);

        return Response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function edit($userId, UserRequest $userRequest)
    {
        $user = $this->userService->update($userId, $userRequest);

        return Response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function delete($userId)
    {
        $user = $this->userService->delete($userId);

        return Response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
