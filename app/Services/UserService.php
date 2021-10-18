<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($request)
    {
        return $this->userRepository->getUser($request);
    }

    public function save($request = [])
    {
        return $this->userRepository->save($request);
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function update($id, $request = [])
    {
        return $this->userRepository->update($id, $request);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
