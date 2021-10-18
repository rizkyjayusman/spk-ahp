<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUser(Request $request);

    public function save($request = []);

    public function getUserById($id);

    public function update($id, $request = []);

    public function delete($id);

    public function getTotalUser();

}
