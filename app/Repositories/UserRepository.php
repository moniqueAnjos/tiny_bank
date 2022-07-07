<?php

namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::orderby('name', 'asc')->paginate();
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function getFieldUserById($userId, $field)
    {
        return User::select($field)->where("id", $userId)->first()->$field;
    }

    public function createUser(array $userDetails)
    {
        return User::create($userDetails);
    }

   
}
